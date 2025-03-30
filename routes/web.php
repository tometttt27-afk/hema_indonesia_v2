<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DataMasterController;
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
        Route::get('/categories', [DataMasterController::class, 'categoriesIndex']);
        Route::prefix('categories')->group(function () {
            Route::get('/add-categories', [DataMasterController::class, 'categoriesAdd']);
            Route::post('/add-categories', [DataMasterController::class, 'categoriesStore'])->name('categoryPost');
            Route::get('/edit-categories/{category_code}', [DataMasterController::class, 'categoriesEdit']);
            Route::put('/edit-categories/{category_code}', [DataMasterController::class, 'categoriesUpdate'])->name('categoryPut');;
            Route::delete('/delete-categories/{category_code}', [DataMasterController::class, 'categoriesDestroy'])->name('categoryDelete');;
        });
        Route::get('/customer', [DataMasterController::class, 'customerIndex']);
        Route::prefix('customer')->group(function () {
            Route::get('/add-customer', [DataMasterController::class, 'customerAdd']);
            Route::post('/add-customer', [DataMasterController::class, 'customerStore'])->name('customerPost');
            Route::get('/edit-customer/{email}', [DataMasterController::class, 'customerEdit']);
            Route::put('/edit-customer/{email}', [DataMasterController::class, 'customerUpdate'])->name('customerPut');;
            Route::delete('/delete-customer/{email}', [DataMasterController::class, 'customerDestroy'])->name('customerDelete');;
        });
        Route::get('/faq-company', [DataMasterController::class, 'faqCompanyIndex']);
        Route::prefix('faq-company')->group(function () {
            Route::get('/add-faq-company', [DataMasterController::class, 'faqCompanyAdd']);
            Route::post('/add-faq-company', [DataMasterController::class, 'faqCompanyStore'])->name('faqCompanyPost');
            Route::get('/edit-faq-company/{code_faq}', [DataMasterController::class, 'faqCompanyEdit']);
            Route::put('/edit-faq-company/{code_faq}', [DataMasterController::class, 'faqCompanyUpdate'])->name('faqCompanyPut');;
            Route::delete('/delete-faq-company/{code_faq}', [DataMasterController::class, 'faqCompanyDestroy'])->name('faqCompanyDelete');;
            Route::put('/status-faq-company/{code_faq}', [DataMasterController::class, 'faqCompanyStatusUpdate'])->name('faqCompanyStatusPut');;
        });
    });
    Route::middleware('role:customer')->group(function () {});
});