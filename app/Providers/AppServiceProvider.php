<?php

namespace App\Providers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Validator;
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
        error_reporting(E_ALL & ~E_USER_DEPRECATED);
        if (app()->environment('production')) {
            error_reporting(E_ALL & ~E_USER_DEPRECATED & ~E_NOTICE & ~E_WARNING);
        }
        /* if ($this->app->environment() !== 'production') {
            $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
            $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
        } */
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	 \URL::forceScheme('https');
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
        Schema::defaultStringLength(191);
        view()->composer(['frontend.includes.header','frontend.includes.cfooter','frontend.layouts.master','frontend.layouts.front_app','frontend.casino_user.import.footer','backend.layouts.app'], function ($view) {

            $data                                  = DB::table('cms')->find(1);
            $view->with([
                'data'                             => $data,
            ]);
        });

    }
}
