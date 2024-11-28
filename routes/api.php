<?php

use App\Http\Controllers\CalanderController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
   Route::post('/messages/store', [MessageController::class, 'sendMessage'])->name('messages.store');
   Route::get('/admin/calander/data', [CalanderController::class, 'getData'])->name('calander.data');