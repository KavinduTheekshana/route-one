<?php

use App\Http\Controllers\CalanderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
   Route::post('/messages/store', [MessageController::class, 'sendMessage'])->name('messages.store');
   Route::get('/admin/calander/data', [CalanderController::class, 'getData'])->name('calander.data');
   Route::get('/search-users-invoice', [InvoiceController::class, 'search'])->name('users.search.invoice');
   Route::get('/search-users-calander', [CalanderController::class, 'search'])->name('users.search.calander');