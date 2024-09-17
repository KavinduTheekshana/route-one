<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', [HomeController::class, 'index'])->name('/');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::middleware(['auth', 'status'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/auth/account', [DashboardController::class, 'account'])->name('auth.account');
    Route::post('/auth/profile/update', [ProfileController::class, 'profile'])->name('auth.profile.update');
    Route::post('/auth/password/update', [ProfileController::class, 'password'])->name('auth.password.update');

    Route::get('/team/manage', [UserController::class, 'team'])->name('team.manage')->middleware(['auth', 'superadmin']);
    Route::get('/team/settings/{user}', [UserController::class, 'settings'])->name('team.settings')->middleware(['auth', 'superadmin']);
    Route::put('/team/update/{user}', [UserController::class, 'update'])->name('team.update')->middleware(['auth', 'superadmin']);
    Route::post('/user/{user}/update-password', [UserController::class, 'updatePassword'])->name('user.password.update')->middleware(['auth', 'superadmin']);
    Route::post('/member/store', [UserController::class, 'member_store'])->name('member.store')->middleware(['auth', 'superadmin']);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(['auth', 'superadmin']);

    });
});

// Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/sample', [HomeController::class, 'sample'])->name('sample')->middleware(['auth', 'superadmin']);

