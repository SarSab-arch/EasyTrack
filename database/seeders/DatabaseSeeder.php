<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
public function run(): void
{
    // 1. إنشاء المستخدم (الأدمن) تلقائياً لتسجيل الدخول بأمان
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@admin.com'],
        [
            'name' => 'Admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'), // ثبتنا كلمة السر هنا واضحة
        ]
    );

    // 2. استدعاء ملف الإعدادات التفصيلي الفخم (الملف رقم 3) ليتم حقنه تلقائياً
    $this->call([
        SettingSeeder::class,
    ]);
}
}
