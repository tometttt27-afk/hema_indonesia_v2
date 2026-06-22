<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
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

    // Lupa & reset password
    Route::get('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AuthenticationController::class, 'processForgotPassword'])->name('forgotPasswordPost');
    Route::get('/reset-password/{token}', [AuthenticationController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthenticationController::class, 'processResetPassword'])->name('resetPasswordPost');
});

Route::get('/', [MainController::class, 'index']);
Route::post('/news-email', [MainController::class, 'news_email'])->name('newsEmailPost');
Route::get('/product', [ProductsController::class, 'index']);
Route::get('/about', [MainController::class, 'about']);
Route::get('/gallery', [MainController::class, 'gallery']);
Route::get('/faq', [MainController::class, 'faq']);

Route::middleware('auth')->group(function () {
    // Profil (admin & customer)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profileUpdate');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profilePasswordUpdate');

    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [MainAdminController::class, 'index']);

        // About / Profil Perusahaan (singleton)
        Route::get('/about-company', [DataMasterController::class, 'aboutCompanyIndex']);
        Route::put('/about-company', [DataMasterController::class, 'aboutCompanyUpdate'])->name('aboutCompanyPut');
        Route::get('/categories', [ProductsController::class, 'categoriesIndex']);
        Route::prefix('categories')->group(function () {
            Route::get('/add-categories', [ProductsController::class, 'categoriesAdd']);
            Route::post('/add-categories', [ProductsController::class, 'categoriesStore'])->name('categoryPost');
            Route::get('/edit-categories/{category_code}', [ProductsController::class, 'categoriesEdit']);
            Route::put('/edit-categories/{category_code}', [ProductsController::class, 'categoriesUpdate'])->name('categoryPut');;
            Route::delete('/delete-categories/{category_code}', [ProductsController::class, 'categoriesDestroy'])->name('categoryDelete');;
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
        Route::get('/gallery-company', [DataMasterController::class, 'galleryCompanyIndex']);
        Route::prefix('gallery-company')->group(function () {
            Route::get('/add-gallery-company', [DataMasterController::class, 'galleryCompanyAdd']);
            Route::post('/add-gallery-company', [DataMasterController::class, 'galleryCompanyStore'])->name('galleryCompanyPost');
            Route::get('/edit-gallery-company/{code_gallery}', [DataMasterController::class, 'galleryCompanyEdit']);
            Route::put('/edit-gallery-company/{code_gallery}', [DataMasterController::class, 'galleryCompanyUpdate'])->name('galleryCompanyPut');;
            Route::delete('/delete-gallery-company/{code_gallery}', [DataMasterController::class, 'galleryCompanyDestroy'])->name('galleryCompanyDelete');;
            Route::put('/status-gallery-company/{code_gallery}', [DataMasterController::class, 'galleryCompanyStatusUpdate'])->name('galleryCompanyStatusPut');;
        });
        Route::get('/product-list', [ProductsController::class, 'productsListIndex']);
        Route::prefix('product-list')->group(function () {
            Route::get('/add-product-list', [ProductsController::class, 'productsListAdd']);
            Route::post('/add-product-list', [ProductsController::class, 'productsListStore'])->name('productsListPost');
            Route::get('/edit-product-list/{code_product}', [ProductsController::class, 'productsListEdit']);
            Route::put('/edit-product-list/{code_product}', [ProductsController::class, 'productsListUpdate'])->name('productsListPut');;
            Route::delete('/delete-product-list/{code_product}', [ProductsController::class, 'productsListDestroy'])->name('productsListDelete');;
            Route::put('/status-product-list/{code_product}', [ProductsController::class, 'productsListStatusUpdate'])->name('productsListStatusPut');;
        });
    });
    Route::middleware('role:customer')->group(function () {});
});