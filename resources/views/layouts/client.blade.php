<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->site_name ?? 'EasyTrack' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/' . ($settings->site_logo ?? 'assets/img/logo.png')) }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    
    @vite(['resources/scss/client.scss'])
    
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<body class="bg-dark text-white">

  <header class="navbar navbar-expand-lg navbar-dark sticky-top bg-blur">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('welcome') }}">
            <img src="{{ $settings?->site_logo ? asset('storage/' . $settings->site_logo) : asset('assets/img/logo.png') }}" height="40" alt="Logo">
            <span class="fw-bold">{{ $settings?->site_name ?? 'EasyTrack' }}</span>
        </a>
        
        <div class="d-flex align-items-center gap-2 order-lg-last">
            <a href="https://wa.me/YOUR_NUMBER" target="_blank" class="btn btn-success btn-sm d-flex align-items-center gap-1 text-white">
                <i class="fab fa-whatsapp"></i> واتساب
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.services') }}">الخدمات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}#track">تتبع التقدم</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}#about">من نحن</a>
                </li>
            </ul>
        </div>
    </div>
</header>
            @if($settings?->whatsapp_number)
                <a href="https://wa.me/{{ $settings->whatsapp_number }}" target="_blank" class="btn btn-cyan btn-sm">واتساب</a>
            @endif
        </div>
    </header>

    @yield('content')

 <footer class="py-4 mt-5 border-top border-secondary" style="direction: rtl; text-align: center; background-color: #121212;">
    <div class="container text-center">
        <p class="mb-2 text-white-50">
            📧 تواصل معنا: 
            <a href="mailto:{{ $settings->contact_email ?? 'support@easytrack.com' }}" style="color: #00ced1; text-decoration: none;">
                {{ $settings->contact_email ?? 'support@easytrack.com' }}
            </a>
        </p>
        
        <div class="social-links mb-3">
            @if($settings->contact_phone)
                <p class="mb-1 text-white-50">
                    📞 رقم الهاتف للاتصال: 
                    <a href="tel:{{ $settings->contact_phone }}" style="color: #fff; text-decoration: none; font-weight: bold;">
                        {{ $settings->contact_phone }}
                    </a>
                </p>
            @endif

            @if($settings->whatsapp_number)
                <p class="mb-1 text-white-50">
                    💬 تواصل عبر الواتساب: 
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" style="color: #00ced1; text-decoration: none; font-weight: bold;">
                        {{ $settings->whatsapp_number }}
                    </a>
                </p>
            @endif
        </div>
        
        <small class="d-block text-muted">
            © 2026 {{ $settings->site_name ?? 'EasyTrack' }}. جميع الحقوق محفوظة.
        </small>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>