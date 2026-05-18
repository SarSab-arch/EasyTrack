<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
       
        $settings = Setting::first() ?? new Setting();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::first() ?? new Setting();
        
      
        $settings->fill($request->except(['site_logo', 'hero_image']));

       
        if ($request->hasFile('site_logo')) {
            $settings->site_logo = $request->file('site_logo')->store('uploads/settings', 'public');
        }

      
        if ($request->hasFile('hero_image')) {
            $settings->hero_image = $request->file('hero_image')->store('uploads/settings', 'public');
        }

        $settings->save();

        return back()->with('success', 'تم تحديث إعدادات الموقع بنجاح!');
    }
}
