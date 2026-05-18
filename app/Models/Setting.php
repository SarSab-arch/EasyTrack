<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
   protected $fillable = [
    'site_name', 'site_logo', 'hero_title', 'hero_image', 
    'about_us', 'contact_email', 'contact_phone', 'whatsapp_number'
];
}
