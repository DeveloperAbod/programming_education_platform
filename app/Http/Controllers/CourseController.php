<?php
/*
status
-1 === قيد مراجعة التعديل
0 === قيد المراجعة
1 === مفعل
2 === موقف
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Auth;

use App\Http\Middleware\CheckUserStatus;
use Illuminate\Http\Request;
use App\Models\Course;



class CourseController extends Controller
{
    function __construct()
    {
        //auth middleware
        $this->middleware('auth');
        $this->middleware(CheckUserStatus::class);
        $this->middleware('permission:عرض الكورسات', ['only' => ['index', 'show']]);
        $this->middleware('permission:اضافة كورس', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل كورس', ['only' => ['edit', 'update']]);
        $this->middleware('permission:تعديل كورس خاص بي', ['only' => ['editMind', 'updateMind']]);
        $this->middleware('permission:حذف كورس', ['only' => ['destroy']]);
        $this->middleware('permission:قبول كورس', ['only' => ['pending_courses', 'show_pending_course', 'update_pending_course']]);
        $this->middleware('permission:ايقاف وتفعيل كورس', ['only' => ['active', 'deactivate']]);
    }
    public function index(Request $request)
    {
        $courses = Course::orderBy('id', 'DESC')->get();
        return view('admin.courses.index', compact('courses'));
    }
    public function show($id)
    {
        $course_info = Course::findOrFail($id);
        return view('admin.courses.show', compact('course_info'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'shortcut' => ['required', 'string', 'max:255'],
            'price' => 'required|numeric|min:1|max:10000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $course = new Course();


        // اضافة الصورة الجديدة
        $randomNumber = mt_rand(1000, 9999); // Generate a random number between 1000 and 9999
        $imageName = time() . '_' . $randomNumber . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);
        $course->image = $imageName;

        $course->name = $request->name;
        $course->shortcut = $request->shortcut;
        $course->price = $request->price;
        $course->description = $request->description;

        // user author
        $user_id = Auth::user()->id;
        $course->user_id = $user_id;



        $course->status = 0;
        if ($request->trending === 'on') {
            $course->trending = true;
        } else {
            $course->trending = false;
        }
        $course->save();
        return redirect("/control/courses/")->with('icon', 'success')->with('msg', 'تم اضافة الكورس بنجاح');
    }
    public function edit($id)
    {
        $course_info = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course_info'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'shortcut' => ['required', 'string', 'max:255'],
            'price' => 'required|numeric|min:1|max:10000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $course = Course::findOrFail($id);

        if ($request->has('image')) {
            //حذف الصورة القديمة
            $file = public_path('uploads/' . $course->image);
            if (File::exists($file)) {
                File::delete($file);
            }
            // اضافة الصورة الجديدة
            $randomNumber = mt_rand(1000, 9999); // Generate a random number between 1000 and 9999
            $imageName = time() . '_' . $randomNumber . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $course->image = $imageName;
        }

        $course->name = $request->name;
        $course->shortcut = $request->shortcut;
        $course->price = $request->price;
        $course->description = $request->description;



        $course->status = -1;

        if ($request->trending === 'on') {
            $course->trending = true;
        } else {
            $course->trending = false;
        }

        $course->save();
        return redirect("/control/courses")->with('icon', 'success')->with('msg', 'تم تحديث  الكورس بنجاح');
    }

    public function editMind($id)
    {
        $course_info = Course::findOrFail($id);
        if ($course_info->user_id != Auth::user()->id) {
            return redirect("/control/courses")->with('icon', 'error')->with('msg', 'غير مسموح لك');
        } else {
            return view('admin.courses.edit_mind', compact('course_info'));
        }
    }
    public function updateMind(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'shortcut' => ['required', 'string', 'max:255'],
            'price' => 'required|numeric|min:1|max:10000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $course = Course::findOrFail($id);
        if ($course->user_id != Auth::user()->id) {
            return redirect("/control/courses")->with('icon', 'error')->with('msg', 'غير مسموح لك');
        }

        if ($request->has('image')) {
            //حذف الصورة القديمة
            $file = public_path('uploads/' . $course->image);
            if (File::exists($file)) {
                File::delete($file);
            }
            // اضافة الصورة الجديدة
            $randomNumber = mt_rand(1000, 9999); // Generate a random number between 1000 and 9999
            $imageName = time() . '_' . $randomNumber . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $course->image = $imageName;
        }

        $course->name = $request->name;
        $course->shortcut = $request->shortcut;
        $course->price = $request->price;
        $course->description = $request->description;



        $course->status = -1;

        if ($request->trending === 'on') {
            $course->trending = true;
        } else {
            $course->trending = false;
        }

        $course->save();
        return redirect("/control/courses")->with('icon', 'success')->with('msg', 'تم تحديث  الكورس بنجاح');
    }


    public function pending_courses()
    {
        $pending_courses = Course::where('status', 0)->orWhere('status', -1)->get();
        return view('admin.courses.pending_courses', compact('pending_courses'));
    }
    public function show_pending_course($id)
    {
        $course_info = Course::findOrFail($id);
        return view('admin.courses.pending_course', compact('course_info'));
    }
    public function update_pending_course(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        if ($request->has('accept')) {
            $course->status = 1;
            $course->save();
            return redirect("/control/courses/pending-courses")->with('icon', 'success')->with('msg', 'تم قبول الكورس بنجاح');
        } else if ($request->has('reject')) {
            $course->status = 2;
            $course->save();
            return redirect("/control/courses/pending-courses")->with('icon', 'success')->with('msg', 'تم رفض الكورس بنجاح');
        } else {
            return redirect("/control/courses/pending-courses")->with('icon', 'error')->with('msg', 'يوجد هنالك خطا جرب مرة اخرى');
        }
    }


    public function active($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 1;
        $course->save();
        return redirect("/control/courses")->with('icon', 'success')->with('msg', 'تم تفعيل الكورس بنجاح');
    }
    public function deactivate($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 2;
        $course->save();
        return redirect("/control/courses")->with('icon', 'success')->with('msg', 'تم ايقاف الكورس بنجاح');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        $file = public_path('uploads/' . $course->image);
        if (File::exists($file)) {
            File::delete($file);
        }
        $course->delete();
        return redirect("/control/courses")->with('icon', 'success')->with('msg', ' تم حذف الكورس بنجاح');
    }
}