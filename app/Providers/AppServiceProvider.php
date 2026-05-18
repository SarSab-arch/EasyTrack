<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

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
    // حيلة ذكية: إذا كان جدول المستخدمين غير موجود، قم بعمل مايجريشن فوراً!
    if (!Schema::hasTable('users')) {
        try {
            Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        } catch (\Exception $e) {
            // تجنب انهيار الموقع إذا كانت القاعدة لم ترتبط بعد
        }
    }
}
}
