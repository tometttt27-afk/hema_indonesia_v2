<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/* ══════════════════════════════════════════════════════════════
   AUTH — Halaman login/register
   Jika sudah login, redirect ke halaman sesuai role.
══════════════════════════════════════════════════════════════ */
Route::prefix('auth')->middleware('guest.redirect')->group(function () {
    Route::get('/sign-in',  [AuthenticationController::class, 'signIn']);
    Route::get('/sign-up',  [AuthenticationController::class, 'signUp']);
    Route::get('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('forgotPassword');
    Route::get('/reset-password/{token}', [AuthenticationController::class, 'resetPassword'])->name('password.reset');
});

Route::prefix('auth')->group(function () {
    Route::post('/process-sign-in',  [AuthenticationController::class, 'proccessSignIn'])->name('isSignIn');
    Route::post('/process-sign-up',  [AuthenticationController::class, 'proccessSignUp'])->name('isSignUp');
    Route::post('/sign-out',         [AuthenticationController::class, 'signOut'])->name('logout');
    Route::post('/forgot-password',  [AuthenticationController::class, 'processForgotPassword'])->name('forgotPasswordPost');
    Route::post('/reset-password',   [AuthenticationController::class, 'processResetPassword'])->name('resetPasswordPost');
});

/* ══════════════════════════════════════════════════════════════
   PUBLIC — Bisa diakses siapa saja (guest & customer)
   Admin yang membuka halaman ini tetap bisa melihat
   (produk, tentang, galeri, faq adalah halaman publik)
══════════════════════════════════════════════════════════════ */
Route::get('/',         [MainController::class, 'index']);
Route::post('/news-email', [MainController::class, 'news_email'])->name('newsEmailPost');
Route::get('/product',  [ProductsController::class, 'index']);
Route::get('/about',    [MainController::class, 'about']);
Route::get('/gallery',  [MainController::class, 'gallery']);
Route::get('/faq',      [MainController::class, 'faq']);

// Midtrans callback — publik, tanpa auth/CSRF
Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('paymentNotification');
Route::get('/payment/finish',        [PaymentController::class, 'finish'])->name('paymentFinish');

/* ══════════════════════════════════════════════════════════════
   ADMIN ROUTES — Hanya role:admin
   Customer yang mencoba buka → redirect ke /
   Guest yang mencoba buka    → redirect ke /auth/sign-in
══════════════════════════════════════════════════════════════ */
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [MainAdminController::class, 'index']);

    // Profil admin
    Route::get('/profile',           [ProfileController::class, 'index'])->name('profile.admin');
    Route::put('/profile',           [ProfileController::class, 'update'])->name('profileUpdate');
    Route::put('/profile/password',  [ProfileController::class, 'updatePassword'])->name('profilePasswordUpdate');

    // About / Profil Perusahaan
    Route::get('/about-company', [DataMasterController::class, 'aboutCompanyIndex']);
    Route::put('/about-company', [DataMasterController::class, 'aboutCompanyUpdate'])->name('aboutCompanyPut');

    // Manajemen Pesanan
    Route::get('/order-list',              [AdminOrderController::class, 'index']);
    Route::get('/order-list/{id}',         [AdminOrderController::class, 'show']);
    Route::put('/order-list/{id}/status',  [AdminOrderController::class, 'updateStatus'])->name('orderStatusPut');
    Route::put('/order-list/{id}/tracking',[AdminOrderController::class, 'updateTracking'])->name('orderTrackingPut');

    // Kategori
    Route::get('/categories', [ProductsController::class, 'categoriesIndex']);
    Route::prefix('categories')->group(function () {
        Route::get('/add-categories',              [ProductsController::class, 'categoriesAdd']);
        Route::post('/add-categories',             [ProductsController::class, 'categoriesStore'])->name('categoryPost');
        Route::get('/edit-categories/{category_code}',    [ProductsController::class, 'categoriesEdit']);
        Route::put('/edit-categories/{category_code}',    [ProductsController::class, 'categoriesUpdate'])->name('categoryPut');
        Route::delete('/delete-categories/{category_code}',[ProductsController::class, 'categoriesDestroy'])->name('categoryDelete');
    });

    // Customer (manajemen oleh admin)
    Route::get('/customer', [DataMasterController::class, 'customerIndex']);
    Route::prefix('customer')->group(function () {
        Route::get('/add-customer',          [DataMasterController::class, 'customerAdd']);
        Route::post('/add-customer',         [DataMasterController::class, 'customerStore'])->name('customerPost');
        Route::get('/edit-customer/{email}', [DataMasterController::class, 'customerEdit']);
        Route::put('/edit-customer/{email}', [DataMasterController::class, 'customerUpdate'])->name('customerPut');
        Route::delete('/delete-customer/{email}',[DataMasterController::class, 'customerDestroy'])->name('customerDelete');
    });

    // FAQ
    Route::get('/faq-company', [DataMasterController::class, 'faqCompanyIndex']);
    Route::prefix('faq-company')->group(function () {
        Route::get('/add-faq-company',               [DataMasterController::class, 'faqCompanyAdd']);
        Route::post('/add-faq-company',              [DataMasterController::class, 'faqCompanyStore'])->name('faqCompanyPost');
        Route::get('/edit-faq-company/{code_faq}',   [DataMasterController::class, 'faqCompanyEdit']);
        Route::put('/edit-faq-company/{code_faq}',   [DataMasterController::class, 'faqCompanyUpdate'])->name('faqCompanyPut');
        Route::delete('/delete-faq-company/{code_faq}',[DataMasterController::class, 'faqCompanyDestroy'])->name('faqCompanyDelete');
        Route::put('/status-faq-company/{code_faq}', [DataMasterController::class, 'faqCompanyStatusUpdate'])->name('faqCompanyStatusPut');
    });

    // Galeri
    Route::get('/gallery-company', [DataMasterController::class, 'galleryCompanyIndex']);
    Route::prefix('gallery-company')->group(function () {
        Route::get('/add-gallery-company',                  [DataMasterController::class, 'galleryCompanyAdd']);
        Route::post('/add-gallery-company',                 [DataMasterController::class, 'galleryCompanyStore'])->name('galleryCompanyPost');
        Route::get('/edit-gallery-company/{code_gallery}',  [DataMasterController::class, 'galleryCompanyEdit']);
        Route::put('/edit-gallery-company/{code_gallery}',  [DataMasterController::class, 'galleryCompanyUpdate'])->name('galleryCompanyPut');
        Route::delete('/delete-gallery-company/{code_gallery}',[DataMasterController::class, 'galleryCompanyDestroy'])->name('galleryCompanyDelete');
        Route::put('/status-gallery-company/{code_gallery}',[DataMasterController::class, 'galleryCompanyStatusUpdate'])->name('galleryCompanyStatusPut');
    });

    // Produk
    Route::get('/product-list', [ProductsController::class, 'productsListIndex']);
    Route::prefix('product-list')->group(function () {
        Route::get('/add-product-list',                [ProductsController::class, 'productsListAdd']);
        Route::post('/add-product-list',               [ProductsController::class, 'productsListStore'])->name('productsListPost');
        Route::get('/edit-product-list/{code_product}',[ProductsController::class, 'productsListEdit']);
        Route::put('/edit-product-list/{code_product}',[ProductsController::class, 'productsListUpdate'])->name('productsListPut');
        Route::delete('/delete-product-list/{code_product}',[ProductsController::class, 'productsListDestroy'])->name('productsListDelete');
        Route::put('/status-product-list/{code_product}',[ProductsController::class, 'productsListStatusUpdate'])->name('productsListStatusPut');
    });
});

/* ══════════════════════════════════════════════════════════════
   CUSTOMER ROUTES — Hanya role:customer
   Admin yang mencoba buka → redirect ke /dashboard
   Guest yang mencoba buka → redirect ke /auth/sign-in
   Customer lain tidak bisa akses data customer lain
   (dijaga di level controller melalui Auth::id())
══════════════════════════════════════════════════════════════ */
Route::middleware(['auth', 'role:customer'])->group(function () {

    // Profil customer (hanya milik sendiri — Auth::id() di controller)
    Route::get('/profile',          [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile',          [ProfileController::class, 'update'])->name('profileUpdate');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profilePasswordUpdate');

    // Wishlist (hanya milik sendiri)
    Route::get('/wishlist',               [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/{product_id}', [WishlistController::class, 'store'])->name('wishlistStore');
    Route::delete('/wishlist/{id}',       [WishlistController::class, 'destroy'])->name('wishlistDestroy');

    // Keranjang (hanya milik sendiri — session per user)
    Route::get('/cart',               [CartController::class, 'index'])->name('cart');
    Route::post('/cart',              [CartController::class, 'store'])->name('cartStore');
    Route::put('/cart/{key}',         [CartController::class, 'update'])->name('cartUpdate');
    // PENTING: cartClear harus SEBELUM cartRemove agar '/cart/clear'
    // tidak di-tangkap oleh Route::delete('/cart/{key}') sebagai key='clear'
    Route::delete('/cart/clear',      [CartController::class, 'clear'])->name('cartClear');
    Route::delete('/cart/{key}',      [CartController::class, 'remove'])->name('cartRemove');

    // Checkout & Pesanan (hanya milik sendiri — Auth::id() di controller)
    Route::get('/checkout',           [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout',          [OrderController::class, 'store'])->name('orderStore');
    Route::get('/orders',             [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}/pay',    [PaymentController::class, 'pay'])->name('orderPay');
    Route::get('/orders/{id}',        [OrderController::class, 'show'])->name('orderShow');
    Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orderCancel');
    Route::put('/orders/{id}/complete',[OrderController::class, 'complete'])->name('orderComplete');
});
