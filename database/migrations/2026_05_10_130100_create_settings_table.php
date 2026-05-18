<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('site_name')->default('EasyTrack');
        $table->string('site_logo')->nullable();
        $table->string('hero_title')->nullable();
        $table->string('hero_image')->nullable();
        $table->text('about_us')->nullable();
        $table->string('contact_email')->nullable();
        $table->string('contact_phone')->nullable();
        $table->string('whatsapp_number')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
