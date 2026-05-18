<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    \App\Models\Setting::updateOrCreate(['id' => 1], [
        'site_name'        => 'EasyTrack',
        'site_logo'        => 'assets/img/logo.png', 
        'hero_title'       => 'هندسة الحلول البرمجية بدقة متناهية',
        'hero_image'       => 'assets/img/hero.jpg',
        'about_us'         => 'نحن في EasyTrack نؤمن بالشفافية؛ لذا نوفر لكِ الأدوات اللازمة لمراقبة جودة تنفيذ خدماتك البرمجية لحظة بلحظة.',
        'contact_email'    => 'admin@easytrack.com',
        'contact_phone'    => '77XXXXXXX',
        'whatsapp_number'  => '96777XXXXXXX',
    ]);
}
}
