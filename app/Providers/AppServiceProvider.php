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
        // حيلة ذكية لتهجير البيانات تلقائياً عند أول إقلاع للموقع
        try {
            if (!Schema::hasTable('users')) {
                Artisan::call('migrate:fresh', [
                    '--seed' => true,
                    '--force' => true,
                ]);
            }
        } catch (\Exception $e) {
            // تجنب انهيار الموقع إذا لم تكن قاعدة البيانات جاهزة بعد
        }
    }
}