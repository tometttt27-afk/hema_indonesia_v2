<?php

namespace App\Providers;

use App\Models\WishlistModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('template.layout-main', function ($view) {
            $cart = Session::get('cart', []);
            $cartCount = 0;
            foreach ($cart as $item) {
                $cartCount += $item['qty'];
            }

            $wishlistCount = Auth::check()
                ? WishlistModel::where('user_id', Auth::id())->count()
                : 0;

            $view->with('cartCount', $cartCount)->with('wishlistCount', $wishlistCount);
        });
    }
}
