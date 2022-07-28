<?php

namespace App\Providers;

use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            if(Session::has('business_id'))
            {
                $unreadOrders = Order::where('retailer_id', Session::get('business_id'))
                ->where('read', 1)
                ->groupBy('tracking_number')
                ->count();
                $view->with('unreadOrders', $unreadOrders);
            }
        });
    }
}
