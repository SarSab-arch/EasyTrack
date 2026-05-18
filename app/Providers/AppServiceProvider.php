<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

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
    // سطر سحري يمسح كاش الإعدادات فوراً عند إقلاع السيرفر
    \Illuminate\Support\Facades\Artisan::call('config:clear');

    try {
        if (!\Illuminate\Support\Facades\Schema::hasTable('users')) {
            \Illuminate\Support\Facades\Artisan::call('migrate:fresh', [
                '--seed' => true,
                '--force' => true,
            ]);
        }
    } catch (\Exception $e) {
        // تجنب الانهيار
    }
}
}