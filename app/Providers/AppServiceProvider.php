<?php

namespace App\Providers;

use App\Components\Cart\BaseCost;
use App\Components\Cart\Cart;
use App\Components\Cart\SessionStorage;
use Illuminate\Container\Container;
use Illuminate\Session\Store;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(Cart::class, function (Container $container){
            return new Cart(
                $container->make(SessionStorage::class, ['session' => $container->get(Store::class), 'key' => 'cart']),
                $container->make(BaseCost::class)
            );
        });
    }
}
