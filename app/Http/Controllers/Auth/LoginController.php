<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() 
    {
        return view('admin.Auth.login');
    }

    public function login(Request $request) 
    {
        $loginValue = trim($request->input('login'));
        $password = $request->input('password');

        //  فحص وتحديد نوع الحقل المدخل تلقائياً
        $field = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        //  محاولة التحقق وتوثيق الجلسة بأمان
        if (Auth::attempt([$field => $loginValue, 'password' => $password])) {
            
            $request->session()->regenerate();
            
            return redirect()->intended('/admin/dashboard'); 
        }

  
        return back()->withErrors(['login' => 'بيانات الدخول غير صحيحة، تأكد من كلمة المرور']);
    }

    public function logout(Request $request) 
    {
        Auth::logout(); 

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect('/login');
    }
}