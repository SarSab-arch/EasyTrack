
@extends('layouts.client')

@section('title', 'الرئيسية')

@section('content')
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-right">
                <h1 class="display-4 fw-bold text-cyan">{{ $settings->hero_title ?? 'هندسة الحلول البرمجية بدقة' }}</h1>
                <p class="lead mt-3">{{ $settings->about_us ?? 'حوّل رؤيتك التقنية إلى واقع ملموس مع نظام تتبع حي لمراحل التطوير.' }}</p>
                <div class="mt-4">
                    <a href="{{ route('client.services') }}" class="btn btn-cyan btn-lg ml-2">اكتشف خدماتنا</a>
                    <a href="#track" class="btn btn-outline-light btn-lg">تتبع طلبك</a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('storage/' . ($settings->hero_image ?? 'assets/img/hero.jpg')) }}" class="img-fluid rounded-custom shadow-lg" alt="EasyTrack Hero">
            </div>
        </div>
    </div>
</section>

<section id="services" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">خدماتنا الاحترافية</h2>
            <p class="text-muted">نقدم حلولاً برمجية متكاملة تضمن جودة الأداء وسهولة التتبع</p>
        </div>
        <div class="row">
            {{-- الـ Loop الآن يمر على المصفوفة المحددة مسبقاً بـ 3 خدمات فقط بقوة وأمان --}}
            @forelse($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="service-card p-4 text-center h-100 d-flex flex-column">
<div class="service-icon mb-3 d-flex align-items-center justify-content-center" style="background: rgba(34, 211, 238, 0.1) !important; border: 2px solid #22d3ee !important; width: 70px !important; height: 70px !important; border-radius: 50% !important; margin: 0 auto 1.5rem !important;">
    <span style="color: #22d3ee !important; font-size: 1.8rem !important; display: inline-block !important;">
        {!! $category->icon ?? '⚙️' !!}
    </span>
</div>
         <h3 class="h4 text-cyan">{{ $category->name }}</h3>
                    <p class="text-light flex-grow-1">{{ Str::limit($category->description, 120, '...') }}</p>
                    <a href="{{ route('client.order', $category->id) }}" class="btn btn-outline-cyan mt-auto">اطلب الخدمة</a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">جاري تجهيز الخدمات الاحترافية قريباً...</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<section id="track" class="py-5 bg-dark-variant">
    <div class="container text-center text-white">
        <h2 class="mb-4">تتبع حالة مشروعك لحظة بلحظة</h2>
        <p class="mb-5">أدخل رقم طلبك لمتابعة نسبة الإنجاز والمهام الحالية</p>
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(session('error'))
                    <div class="alert alert-danger border-0 shadow-sm mb-3 text-right" role="alert">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('client.track.search') }}" method="GET">
                    <div class="input-group mb-3 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                        <input type="text" 
                               name="order_number" 
                               autocomplete="off"
                               class="form-control bg-light text-dark border-cyan p-3" 
                               placeholder="أدخل رقم التتبع، البريد الإلكتروني، أو رقم الهاتف" 
                               required>
                        
                        <button class="btn btn-cyan px-4 fw-bold" type="submit">
                            تتبع الآن
                        </button>
                    </div>
                    <div class="text-right">
                        <small class="text-white-50 ms-2">
                            <i class="fas fa-info-circle"></i> يمكنك العثور على طلبك حتى لو فقدت رقم التتبع.
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section id="about" class="py-5">
    <div class="container text-center">
        <h2 class="text-cyan mb-4">من نحن</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="mb-4">
                    {{ $settings->about_us ?? 'نحن منصة EasyTrack، نهدف لتوفير الشفافية الكاملة بين المبرمج والعميل من خلال نظام تتبع حي للمشاريع.' }}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection