<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);
        
        View::share('key');
        View::share('towed_totals');
        View::share('unauth_total');
        View::share('auth_total');
        View::share('jan');
        View::share('feb');
        View::share('mar');
        View::share('apr');
        View::share('may');
        View::share('jun');
        View::share('jul');
        View::share('aus');
        View::share('sep');
        View::share('oct');
        View::share('nov');
        View::share('dec');
        
        View::share('jan_2019');
        View::share('feb_2019');
        View::share('mar_2019');
        View::share('apr_2019');
        View::share('may_2019');
        View::share('jun_2019');
        View::share('jul_2019');
        View::share('aus_2019');
        View::share('sep_2019');
        View::share('oct_2019');
        View::share('nov_2019');
        View::share('dec_2019');

        View::share('jan_2018');
        View::share('feb_2018');
        View::share('mar_2018');
        View::share('apr_2018');
        View::share('may_2018');
        View::share('jun_2018');
        View::share('jul_2018');
        View::share('aus_2018');
        View::share('sep_2018');
        View::share('oct_2018');
        View::share('nov_2018');
        View::share('dec_2018');
        View::share('alert');     
        
        //Customer Feed Back
        View::share('total'); 
        View::share('happy');
        View::share('unavailable');
        View::share('workman');
        View::share('comm');
        View::share('other');

        
        //Line Manager
        View::share('total_users');
        View::share('total_workshop');
        View::share('total_admin');
        View::share('total_drivers');

        View::share('position');
        View::share('admin');
        View::share('quote');
        View::share('customer');
        View::share('consumable');
        View::share('line');
        View::share('Key');
        
        //Final Stage
        View::share('operatations');
        View::share('check_oper');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
