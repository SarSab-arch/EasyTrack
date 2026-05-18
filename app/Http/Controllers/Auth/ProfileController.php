<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller

{
    
    public function edit()
    {
        return view('admin.profile.edit', ['user' => Auth::user()]);
    }

   public function update(Request $request)
{
   
    $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());

   
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
    }

  
    if ($user->save()) {
        return back()->with('success', 'تم تحديث بياناتك الشخصية بنجاح! ✅');
    }

    return back()->with('error', 'حدث خطأ ما، لم يتم الحفظ.');
}

}
