@extends('layouts.client')

@section('title', 'طلباتك السابقة')

@section('content')
<div class="container py-5" style="min-height: 75vh;">
    <h3 class="mb-4 text-center text-white fw-bold"> طلباتك السابقة والمستندة لبياناتك</h3>
    <p class="text-center text-white-50 mb-5">اضغط على زر "متابعة الطلب" للاطلاع على تفاصيل ونسبة إنجاز كل مشروع</p>
    
    <div class="row justify-content-center">
        @forelse($tasks as $task)
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg border border-secondary text-white p-2" style="border-radius: 15px; background-color: #1a1a1a;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="text-right">
                        <h5 class="fw-bold mb-2 text-cyan">{{ $task->category->name ?? 'خدمة عامة' }}</h5>
                        <small class="text-white-50 d-block">
                            <i class="fas fa-fingerprint"></i> رقم التتبع: <span class="text-info">{{ $task->tracking_id }}</span>
                        </small>
                        <small class="d-block mt-1">
                            <i class="far fa-calendar-alt"></i> تاريخ الطلب: {{ $task->created_at->format('Y-m-d') }}
                        </small>
                    </div>
                    <a href="{{ route('client.track', $task->tracking_id) }}" class="btn btn-cyan btn-sm fw-bold px-3">
                        متابعة الطلب
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-8 text-center py-5">
            <div class="text-muted mb-3">
                <i class="fas fa-folder-open fa-3x text-secondary"></i>
            </div>
            <h5 class="text-white-50">لم نجد أي طلبات مسجلة تحت هذا البريد أو رقم الهاتف.</h5>
            <a href="{{ route('welcome') }}" class="btn btn-outline-cyan btn-sm mt-3">العودة للرئيسية والمحاولة مجدداً</a>
        </div>
        @endforelse
    </div>
</div>
@endsection