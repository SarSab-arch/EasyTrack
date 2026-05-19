<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $settings?->site_name ?? 'EasyTrack' }} - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ $settings?->site_logo ? asset('storage/' . $settings->site_logo) : asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    @vite(['resources/scss/admin.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header d-flex align-items-center gap-2 px-3 py-3">
                <img src="{{ $settings?->site_logo ? asset('storage/' . $settings->site_logo) : asset('assets/img/logo.png') }}" height="40" alt="Logo">
                <h3 class="m-0 fs-5 text-white">{{ $settings?->site_name ?? 'EasyTrack' }}</h3>
            </div>

            <ul class="list-unstyled components">
    <li>
        <a href="{{ route('admin.dashboard') }}">
            📊 <span>لوحة القيادة</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.categories.index') }}">
            🛠️ <span>إدارة الخدمات</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.tasks.index') }}">
            📥 <span>الطلبات الواردة</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.reports.index') }}">
            📈 <span>التقارير</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.settings.index') }}">
            ⚙️ <span>إعدادات الموقع</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.profile.edit') }}">
            👤 <span>الملف الشخصي</span>
        </a>
    </li>
    
    <li class="px-3 mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-info w-100"> تسجيل الخروج</button>
        </form>
    </li>
</ul>
        </nav>
    
        <div id="content">
            <nav class="navbar navbar-light bg-white shadow-sm mb-4">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">@yield('page_title')</span>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>
</body>
</html>