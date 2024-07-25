<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;




//custom Auth
Route::prefix('/control')->group(function () {
    // Login Routes
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->middleware('redirectIfAuthenticated')->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->middleware('redirectIfAuthenticated');
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    // Registration Routes
    Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->middleware('redirectIfAuthenticated')->name('register');
    Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->middleware('redirectIfAuthenticated');

    // Password Reset Routes
    Route::get('password/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

    // Email Verification Routes
    Route::get('email/verify', [\App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [\App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
});


//index
Route::get('/control', [HomeController::class, 'index'])->name('control');

// roles
Route::controller(RoleController::class)->group(function () {
    Route::get('control/roles', 'index');
    Route::get('control/roles/add', 'create');
    Route::post('control/roles/store', 'store');
    Route::get('control/roles/{id}/show', 'show');
    Route::get('control/roles/{id}/edit', 'edit');
    Route::put('control/roles/{id}/update', 'update');
    Route::delete('control/roles/{id}/delete', 'destroy');
});

// users
Route::controller(UserController::class)->group(function () {
    Route::get('control/users', 'index');
    Route::get('control/users/{id}/show', 'show');
    Route::get('control/users/create', 'create');
    Route::post('control/users/store', 'store');
    Route::get('control/users/{id}/edit', 'edit');
    Route::put('control/users/{id}/update', 'update');
    Route::delete('control/users/{id}/delete', 'destroy');
    Route::get('control/profile', 'index_profile')->name('user_profile');
    Route::put('control/changePassword', 'changePassword')->name('change_password');
    Route::put('control/update_profile', 'update_profile')->name('update_profile');
});


// courses
Route::controller(CourseController::class)->group(function () {
    Route::get('control/courses', 'index');
    Route::get('control/courses/create', 'create');
    Route::post('control/courses/store', 'store');
    Route::get('control/courses/{id}/show', 'show');
    Route::get('control/courses/{id}/edit', 'edit');
    Route::put('control/courses/{id}/update', 'update');

    Route::get('control/courses/{id}/editMind', 'editMind')->name('edit_courses_mind');
    Route::put('control/courses/{id}/updateMind', 'updateMind')->name('update_courses_mind');

    Route::get('control/courses/pending-courses', 'pending_courses')->name('pending_courses');
    Route::get('control/courses/{id}/pending-course', 'pending_course')->name('pending_course');
    Route::put('control/courses/{id}/update-pending-course', 'update_pending_course')->name('update_pending_course');

    Route::get('control/courses/{id}/active', 'active')->name('active_course');
    Route::get('control/courses/{id}/deactivate', 'deactivate')->name('deactivate_course');

    Route::delete('control/courses/{id}/delete', 'destroy');
});



// deactive login
Route::get('/control/deactive', function () {
    if (!Auth::check()) {
        return view('admin.errors.deactive');
    } else {
        return redirect("/control");
    }
});
