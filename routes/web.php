<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\FrontController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\Auth\ProfileController;

/*
|--------------------------------------------------------------------------
| 1. مسارات العميل (الواجهة الأمامية)
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontController::class, 'index'])->name('welcome');
Route::get('/services', [FrontController::class, 'services'])->name('client.services');

// مسارات الطلبات
Route::get('/order/{id}', [FrontController::class, 'orderForm'])->name('client.order');
Route::post('/order/store', [FrontController::class, 'store'])->name('client.order.store');

// صفحة النجاح (تستقبل رقم التتبع لعرضه للعميل)
Route::get('/order-success/{tracking_id}', [FrontController::class, 'orderSuccess'])->name('order.success');

// مسارات التتبع (البحث وعرض النتائج)
Route::get('/track/search', [FrontController::class, 'trackSearch'])->name('client.track.search');
Route::get('/track/{tracking_id}', [FrontController::class, 'track'])->name('client.track');


/*
|--------------------------------------------------------------------------
| 2. مسارات تسجيل الدخول (Authentication)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 3. مسارات لوحة التحكم (الأدمن - محمية بـ auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // لوحة التحكم الرئيسية
    Route::get('/dashboard', [CategoryController::class, 'dashboard'])->name('dashboard');

    // إدارة الأقسام والطلبات
    Route::resource('categories', CategoryController::class);
    Route::resource('tasks', TaskController::class);
    
    // تحديث حالة الطلب
    Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    // الإعدادات والتقارير
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // الملف الشخصي (Profile)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
use Illuminate\Support\Facades\Artisan;

Route::get('/run-migrations', function () {
    try {
        Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        return 'قاعدة البيانات تم بناؤها وضخ البيانات بنجاح تام! 🎉';
    } catch (\Exception $e) {
        return 'حدث خطأ: ' . $e->getMessage();
    }
});