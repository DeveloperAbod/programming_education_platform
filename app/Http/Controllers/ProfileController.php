<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Middleware\CheckUserStatus;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function __construct()
    {
        //auth middleware
        $this->middleware('auth');
        $this->middleware(CheckUserStatus::class);
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $user_info = User::findOrFail($user_id);
        return view('admin.profile', compact('user_info'));
    }
    public function changePassword(Request $request)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail($user_id);


        if (!Hash::check(
            $request->current_password,
            $user->password
        )) {

            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect("/control/profile")->with('icon', 'success')->with('msg', 'تم تغيير كلمة المرور بنجاح');
    }

    public function update(Request $request)
    {
        $user_id = Auth::user()->id;

        $user = User::findOrFail($user_id);
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'email' => ['required', 'email', 'required', Rule::unique('users')->ignore($user->id)],
            'phone' => ['numeric', 'digits:9', 'required', 'regex:/^7[0-9]{8}$/', Rule::unique('users')->ignore($user->id)]
        ]);
        if ($request->has('avatar')) {
            //حذف الصورة القديمة
            $file = public_path('uploads/' . $user->avatar);
            if (File::exists($file) && $user->avatar != 'defaultUserImage.png') {
                File::delete($file);
            }
            // اضافة الصورة الجديدة
            $randomNumber = mt_rand(1000, 9999); // Generate a random number between 1000 and 9999
            $imageName = time() . '_' . $randomNumber . '.' . $request->avatar->extension();

            $request->avatar->move(public_path('uploads'), $imageName);
            $user->avatar = $imageName;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return redirect("/control/profile")->with('icon', 'success')->with('msg', 'تم تعديل الملف الشخصي بنجاح');
    }
}
