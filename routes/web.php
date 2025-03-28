<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('auth')->group(function () {
    Route::get('/sign-in', [AuthenticationController::class, 'signIn']);
    Route::post('/process-sign-in', [AuthenticationController::class, 'proccessSignIn'])->name('isSignIn');
    Route::get('/sign-up', [AuthenticationController::class, 'signUp']);
    Route::post('/process-sign-up', [AuthenticationController::class, 'proccessSignUp'])->name('isSignUp');
    Route::post('/sign-out', [AuthenticationController::class, 'signOut'])->name('logout');
});

Route::get('/', [MainController::class, 'index']);
Route::post('/news-email', [MainController::class, 'news_email'])->name('newsEmailPost');
Route::get('/product', [ProductController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);
Route::get('/gallery', [MainController::class, 'gallery']);
Route::get('/faq', [MainController::class, 'faq']);

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [MainAdminController::class, 'index']);
    });
    Route::middleware('role:customer')->group(function () {});
});