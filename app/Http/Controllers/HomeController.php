<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUserStatus;
use App\Models\course as ModelsCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Course;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckUserStatus::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users_unm = User::all()->count();
        $Roles_unm = Role::all()->count();
        $courses_unm = Course::all()->count();


        return view('admin.index', compact('users_unm', 'Roles_unm', 'courses_unm'));
    }
}
