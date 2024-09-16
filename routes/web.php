<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/auth/account', [DashboardController::class, 'account'])->name('auth.account');
    Route::post('/auth/profile/update', [ProfileController::class, 'profile'])->name('auth.profile.update');
    Route::post('/auth/password/update', [ProfileController::class, 'password'])->name('auth.password.update');


});

// Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/sample', [HomeController::class, 'sample'])->name('sample')->middleware(['auth','superadmin']);
