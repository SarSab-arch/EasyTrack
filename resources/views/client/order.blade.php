@extends('layouts.client')

@section('title', 'طلب خدمة: ' . $category->name)

@section('content')
<div class="container py-5">
    <div class="custom-card col-md-8 mx-auto p-4" style="background-color: #1a1a1a; border-radius: 15px; border: 1px solid #00ced1;">
        <h2 class="text-center mb-4" style="color: #00ced1;">طلب خدمة: {{ $category->name }}</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger border-0 text-right mb-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('client.order.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="category_id" value="{{ $category->id }}">

            <div class="mb-3">
                <label class="text-white mb-2">اسمك الكريم (الاسم الكامل)</label>
                <input type="text" name="customer_name" class="form-control bg-dark text-white border-secondary" required placeholder="ادخل اسمك هنا">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="text-white mb-2">بريدك الإلكتروني</label>
                    <input type="email" name="client_email" class="form-control bg-dark text-white border-secondary" required placeholder="example@mail.com">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="text-white mb-2">رقم الهاتف (واتساب)</label>
                    <input type="text" name="client_phone" class="form-control bg-dark text-white border-secondary" required placeholder="05xxxxxxx">
                </div>
            </div>

            <div class="mb-3">
                <label class="text-white mb-2">الموعد النهائي المطلوب (Deadline)</label>
                <input type="date" name="deadline" class="form-control bg-dark text-white border-secondary" 
                       min="{{ date('Y-m-d', strtotime('+' . ($category->min_days_required ?? 0) . ' days')) }}" required>
                <small style="color: #00ced1;" class="d-block mt-1">
                    <i class="fas fa-info-circle"></i> أقل مدة لتنفيذ هذه الخدمة هي: {{ $category->min_days_required ?? 1 }} أيام
                </small>
            </div>

            <div class="mb-3">
                <label class="text-white mb-2">وصف الطلب / ملاحظات إضافية</label>
                <textarea name="order_description" class="form-control bg-dark text-white border-secondary" rows="4" placeholder="اكتب تفاصيل طلبك هنا..."></textarea>
            </div>

            <button type="submit" class="btn btn-easytrack w-100 fw-bold py-2.5" style="background-color: #00ced1; color: #1a1a1a;">
                إرسال الطلب للمراجعة
            </button>
        </form>
    </div>
</div>

<style>
    .btn-easytrack:hover {
        background-color: #008b8b !important;
        color: white !important;
        transition: 0.3s ease;
    }
</style>
@endsection