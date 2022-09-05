<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/user-balance', \App\Http\Controllers\UserController::class);
Route::apiResource('/bill', \App\Http\Controllers\BillController::class);
Route::apiResource('/transaction', \App\Http\Controllers\TransactionController::class);
Route::apiResource('/inquiry', \App\Http\Controllers\InquiryController::class);
