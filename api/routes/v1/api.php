<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostsController;
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

//Route::apiResource('posts', PostsController::class);

Route::group(['prefix' => '/posts', 'as' => 'posts.'], function () {
  Route::get('/', [PostsController::class, 'index'])->name('get');
  Route::post('/', [PostsController::class, 'store'])->name('store')->middleware('auth:sanctum');
//  Route::get('/{post}', [PostsController::class, 'show'])->name('show');
//  Route::delete('/{id}', [PostsController::class, 'destroy'])->name('destroy');
//  // Updating
//  Route::post('/image-upload', [PostsController::class, 'uploadPostImage'])->name('image.upload');
//  Route::post('/{id}/like', [PostsController::class, 'likeUnlike'])->name('likes.like-unlike');
});
