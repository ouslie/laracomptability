<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Base;
use Auth;
use Session;

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
        $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
        $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);




            view()->composer('*', function ($view)
            {
                $bases       = Base::where('user_id', '=', Auth::id())->get();

                if (Session::has('base_id')) {
                    $active_base = Session::get('base_id');
                } else {
                    $active_base = Session::put('base_id', Base::defaultbase());
                }

                //...with this variable
                $view->with('bases', $bases );
                $view->with('active_base', $active_base );
            });

    }
}
