@extends('layouts.admin')

@section('content')
<div class="container py-5" style="direction: rtl; text-align: right;">
    
    @if(session('success'))
        <div class="alert alert-success mb-4" style="background-color: #00ced1; color: #1a1a1a; border: none; font-weight: bold; border-radius: 10px;">
            📢 {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">تفاصيل الطلب <span style="color: #00ced1;">#{{ $task->id }}</span></h2>
        <a href="{{ route('admin.tasks.index') }}" class="btn btn-outline-secondary">العودة للجدول</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4" style="background-color: #1a1a1a; border: 1px solid #333; color: white; border-radius: 12px;">
                <div class="card-header" style="border-bottom: 1px solid #00ced1; background-color: transparent;">
                    <h5 class="mb-0 text-info fw-bold">بيانات العميل</h5>
                </div>
                <div class="card-body">
                    <p><strong>رقم المتابعة (Tracking ID):</strong> <span class="text-white-50">{{ $task->tracking_id }}</span></p>
                    <p><strong>الاسم:</strong> {{ $task->customer_name }}</p>
                    <p><strong>الإيميل:</strong> <a href="mailto:{{ $task->client_email }}" style="color: #fff; text-decoration: none;">{{ $task->client_email }}</a></p>
                    <p><strong>واتساب:</strong> <a href="https://wa.me/{{ $task->client_phone }}" target="_blank" style="color: #00ced1; font-weight: bold;">{{ $task->client_phone }}</a></p>
                    <hr style="background-color: #444; border-top: 1px solid #444;">
                    <p><strong>الخدمة المطلوبة:</strong> <span class="text-info">{{ $task->category->name ?? 'غير محدد' }}</span></p>
                    <p><strong>الموعد النهائي:</strong> <span class="text-warning">{{ $task->deadline }}</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4" style="background-color: #1a1a1a; border: 1px solid #333; color: white; border-radius: 12px;">
                <div class="card-header" style="border-bottom: 1px solid #00ced1; background-color: transparent;">
                    <h5 class="mb-0 text-info fw-bold">وصف الطلب التفصيلي</h5>
                </div>
                <div class="card-body">
                    <div class="p-3 mb-4" style="background-color: #0c0c0c; border-radius: 10px; border: 1px solid #222; line-height: 1.6;">
                        {{ $task->order_description }}
                    </div>

                    <h5 class="text-white mb-3 fw-bold">تحديث حالة الطلب الحالي:</h5>
                    <form action="{{ route('admin.tasks.updateStatus', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row g-2">
                            <div class="col-md-8">
                                <select name="status" class="form-select bg-dark text-white border-secondary py-2">
                                    <option value="under_review" {{ $task->status == 'under_review' ? 'selected' : '' }}>تحت المراجعة</option>
                                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>بدء التنفيذ (قبول)</option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                                    <option value="rejected" {{ $task->status == 'rejected' ? 'selected' : '' }}>رفض الطلب</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn w-100 py-2 fw-bold" style="background-color: #00ced1; color: #000;">تحديث الحالة</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection