<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
  Route::post('login', [AuthenticationController::class, 'login'])->name('login');
  Route::post('register', [AuthenticationController::class, 'register'])->name('register');
  Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
});
