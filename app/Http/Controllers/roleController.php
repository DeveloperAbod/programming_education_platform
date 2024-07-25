<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\CheckUserStatus;


class RoleController extends Controller
{


    function __construct()
    {
        //auth middleware
        $this->middleware('auth');
        $this->middleware(CheckUserStatus::class);
        $this->middleware('permission:عرض الصلاحيات', ['only' => ['index', 'show']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }



    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.add', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);

        // Retrieve and sync permissions
        $permissions = Permission::whereIn('id', $request->input('permission'))->get();
        $role->syncPermissions($permissions);
        return redirect("/control/roles")->with('icon', 'success')->with('msg', 'تم اضافة الصلاحية بنجاح');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('admin.roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        // Retrieve and sync permissions
        $permissions = Permission::whereIn('id', $request->input('permission'))->get();
        $role->syncPermissions($permissions);
        return redirect("/control/roles")->with('icon', 'success')->with('msg', 'تم تحديث الصلاحية بنجاح');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect("/control/roles")->with('icon', 'success')->with('msg', 'تم  حذف الصلاحية بنجاح');
    }
}
