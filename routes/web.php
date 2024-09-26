<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('jobs', [HomeController::class, 'jobs'])->name('jobs');
Route::get('services', [HomeController::class, 'services'])->name('services');
Route::get('user/login', [HomeController::class, 'login'])->name('user.login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // User Routes
    Route::post('/user/profile/update/image', [AccountController::class, 'profile_image'])->name('user.profile.update.image');
    Route::post('/user/profile/update/details', [AccountController::class, 'profile_details'])->name('user.profile.update.details');
    Route::get('/user/application', [AccountController::class, 'application'])->name('user.application');
    Route::get('/user/documents', [AccountController::class, 'documents'])->name('user.documents');
    Route::post('/user/application/store', [AccountController::class, 'store'])->name('user.application.store');

    Route::middleware(['auth', 'status'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/auth/account', [DashboardController::class, 'account'])->name('auth.account');
    Route::post('/auth/profile/update', [ProfileController::class, 'profile'])->name('auth.profile.update');
    Route::post('/auth/password/update', [ProfileController::class, 'password'])->name('auth.password.update');

    Route::get('/team/manage', [UserController::class, 'team'])->name('team.manage')->middleware(['auth', 'superadmin']);
    Route::get('/team/settings/{user}', [UserController::class, 'settings'])->name('team.settings')->middleware(['auth', 'superadmin']);
    Route::get('/team/block/{user}', [UserController::class, 'block'])->name('team.block')->middleware(['auth', 'superadmin']);
    Route::get('/team/unblock/{user}', [UserController::class, 'unblock'])->name('team.unblock')->middleware(['auth', 'superadmin']);
    Route::put('/team/update/{user}', [UserController::class, 'update'])->name('team.update')->middleware(['auth', 'superadmin']);
    Route::post('/user/{user}/update-password', [UserController::class, 'updatePassword'])->name('user.password.update')->middleware(['auth', 'superadmin']);
    Route::post('/member/store', [UserController::class, 'member_store'])->name('member.store')->middleware(['auth', 'superadmin']);
    Route::delete('/team/{user}', [UserController::class, 'destroy'])->name('team.destroy')->middleware(['auth', 'superadmin']);

    // admin, superadmin and agent
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware(['auth', 'superadmin']);
    Route::get('/user/manage', [UserController::class, 'users'])->name('user.manage')->middleware(['auth', 'superadmin']);
    Route::get('/user/block/{user}', [UserController::class, 'user_block'])->name('user.block')->middleware(['auth', 'superadmin']);
    Route::get('/user/unblock/{user}', [UserController::class, 'user_unblock'])->name('user.unblock')->middleware(['auth', 'superadmin']);
    Route::delete('/users/{user}', [UserController::class, 'user_destroy'])->name('user.destroy')->middleware(['auth', 'superadmin']);
    Route::post('/user/submit/details', [UserController::class, 'details'])->name('user.submit.details')->middleware(['auth', 'superadmin']);
    Route::get('/user/settings/{user}', [UserController::class, 'user_settings'])->name('user.settings')->middleware(['auth', 'superadmin']);
    Route::put('/user/update/{user}', [UserController::class, 'user_update'])->name('user.update')->middleware(['auth', 'superadmin']);

    Route::resource('documents', DocumentController::class);


    });
});

// Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/sample', [HomeController::class, 'sample'])->name('sample')->middleware(['auth', 'superadmin']);

