<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
  if (config('app.env') === 'production' || env('APP_URL') !== 'http://localhost') {
        URL::forceScheme('https');
    }
    \Illuminate\Support\Facades\View::share('settings', \App\Models\Setting::first());
}
}