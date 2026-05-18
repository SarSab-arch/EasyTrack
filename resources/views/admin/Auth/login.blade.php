<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- جلب اسم الموقع من الإعدادات أو استخدام اسم افتراضي --}}
    @php
        // جلب أول سطر من الإعدادات، ثم الوصول لعمود site_name مباشرة
        $setting = \App\Models\Setting::first();
        $siteName = $setting->site_name ?? 'EasyTrack';
    @endphp
    <title>تسجيل الدخول | {{ $siteName }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0b0b0b; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .login-card {
            background-color: #161616;
            border: 1px solid #00ced1;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 206, 209, 0.2);
            width: 400px;
            padding: 30px;
        }
        .form-control { background-color: #222; border: 1px solid #333; color: white; }
        .form-control:focus { background-color: #2a2a2a; color: white; border-color: #00ced1; box-shadow: none; }
        .btn-turquoise { background-color: #00ced1; color: black; font-weight: bold; transition: 0.3s; }
        .btn-turquoise:hover { background-color: #20b2aa; transform: translateY(-2px); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="login-card">
        {{-- العنوان يتغير ديناميكياً هنا أيضاً --}}
        <h3 class="text-center mb-4" style="color: #00ced1;">نظام {{ $siteName }} 🔐</h3>
        
        @if($errors->any())
            <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label text-light small">اسم المستخدم أو البريد الإلكتروني</label>
                {{-- تعديل برمي مهم: إضافة دالة old('login') للاحتفاظ بالنص المكتوب في حال الخطأ --}}
                <input type="text" name="login" value="{{ old('login') }}" class="form-control" placeholder="admin أو email@example.com" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label text-light small">كلمة المرور</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-turquoise w-100 mt-2">تسجيل الدخول</button>
        </form>
    </div>

</body>
</html>