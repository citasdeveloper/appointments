<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware('throttle:530,1')->group(function () {
    Route::post('auth/signup', [App\Http\Controllers\Api\AuthController::class, 'signup'])->name('signup');
    Route::post('auth/login', [App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');
});

Route::prefix('v1')->namespace('App\Http\Controllers')->middleware('auth:sanctum')->group(function () {
    Route::get('appointments', [AppointmentController::class, 'index'])->middleware(\App\Http\Middleware\checkRole::class.':user');
    Route::get('admin/appointments', [AppointmentController::class, 'index'])->middleware(\App\Http\Middleware\checkRole::class.':admin');
});

Route::apiResource('services', ServiceController::class);
