<?php

namespace App\Providers;

use App\Models\WishlistModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        /*
        |--------------------------------------------------------------
        | SESSION COOKIE SEPARATION — Admin vs Customer
        |--------------------------------------------------------------
        | Admin dan customer menggunakan cookie session berbeda:
        |   - Admin   : {app_name}_admin_session
        |   - Customer: {app_name}_session  (default)
        |
        | Ini mencegah satu browser tab menimpa login tab lain
        | meski keduanya mengakses domain yang sama.
        |--------------------------------------------------------------
        */
        $request = app('request');
        $isAdminRoute = $request->is(
            'dashboard*', 'product-list*', 'categories*',
            'order-list*', 'customer*', 'gallery-company*',
            'faq-company*', 'about-company*'
        );

        if ($isAdminRoute) {
            $appName = str_replace(' ', '_', strtolower(config('app.name', 'laravel')));
            config(['session.cookie' => $appName . '_admin_session']);
        }
        /*
        |--------------------------------------------------------------
        | VIEW COMPOSER — cartCount & wishlistCount
        |--------------------------------------------------------------
        | Di-share ke SEMUA view yang extend layout-main.
        | Composer diikat ke wildcard 'template.*' agar tetap tersedia
        | bahkan jika layout dipanggil sebagai sub-view atau komponen.
        | Juga diikat ke root pattern '*' untuk memastikan tidak ada
        | halaman customer yang kehilangan kedua variabel ini.
        |
        | Logika:
        |   - cartCount    : jumlah total item (bukan baris) di session
        |   - wishlistCount: total baris di tabel wishlist milik user
        |--------------------------------------------------------------
        */
        $customerComposer = function ($view) {
            // Cart — dari session (tidak perlu DB)
            $cart      = Session::get('cart', []);
            $cartCount = 0;
            foreach ($cart as $item) {
                $cartCount += (int) ($item['qty'] ?? 0);
            }

            // Wishlist — dari DB, hanya jika user login
            $wishlistCount = 0;
            if (Auth::check()) {
                $wishlistCount = WishlistModel::where('user_id', Auth::id())->count();
            }

            $view->with('cartCount', $cartCount)
                 ->with('wishlistCount', $wishlistCount);
        };

        // Ikat ke layout (parent) DAN semua view yang extend-nya
        View::composer('template.layout-main', $customerComposer);

        // Ikat juga ke semua view customer agar tidak ada yang ketinggalan
        // saat Blade meng-compile @extends sebelum layout di-render
        View::composer([
            'main.*',
            'product.*',
            'cart.*',
            'orders.*',
            'order.*',
            'wishlist.*',
            'payment.*',
            'profile.customer',
            'auth.*',
        ], $customerComposer);
    }
}
