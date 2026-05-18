@extends('layouts.client')

@section('title', 'تم إرسال الطلب بنجاح')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card shadow-lg text-center" style="max-width: 600px; border-radius: 20px; border: none; background-color: #1a1a1a;">
        
        <div class="card-body p-5">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#00ced1" class="bi bi-check2-circle" viewBox="0 0 16 16">
                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
            </div>

            <h2 class="fw-bold mb-3" style="color: #00ced1;">تم استلام طلبك بنجاح!</h2>
            <p class="text-white-50 mb-4 fs-5">
                شكراً لثقتك بـ <span style="color: #00ced1; font-weight: bold;">{{ $settings->site_name ?? 'EasyTrack' }}</span>. 
                لقد تم إرسال طلبك للمراجعة، وسيقوم فريقنا بالتواصل معك عبر الواتساب أو الإيميل قريباً.
            </p>

            <div class="bg-dark rounded-3 p-3 mb-4 border border-secondary">
                <span class="text-white-50 d-block">رقم الطلب الخاص بك:</span>
                <h4 class="text-white mb-0 mt-1">#{{ $task->tracking_id }}</h4>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('welcome') }}" class="btn btn-lg text-dark fw-bold" style="background-color: #00ced1; border-radius: 10px;">
                    العودة للرئيسية
                </a>
                
                <button onclick="window.print()" class="btn btn-outline-secondary text-white fw-bold" style="border-radius: 10px;">
                    🖨️ حفظ تفاصيل الطلب (PDF)
                </button>

                @if($settings?->whatsapp_number)
                    <a href="https://wa.me/{{ $settings->whatsapp_number }}" target="_blank" class="btn btn-outline-info btn-sm border-0 mt-2">
                        تواصل معنا مباشرة عبر واتساب
                    </a>
                @endif
            </div>
        </div>

        <div class="card-footer bg-transparent border-0 pb-4">
            <p class="small text-cyan mb-">سيتم إشعارك عند تغيير حالة الطلب إلى "قيد التنفيذ"</p>
        </div>
    </div>
</div>

<style>
    body {
        background: radial-gradient(circle at top right, #1a1a1a, #0d0d0d) !important;
    }
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }
    /* استعلام الطباعة لتأمين مظهر الصفحة عند استخراجها كـ PDF */
    @media print {
        header, footer, .btn, button, .text-muted {
            display: none !important;
        }
        body {
            background: white !important;
            color: black !important;
        }
        .card {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection