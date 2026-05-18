@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="custom-card">
        <h2 class="mb-4" style="color: #00ced1;">إضافة خدمة جديدة 🛠️</h2>
        
        @if($errors->any())
            <div class="alert alert-danger py-2 small" style="background-color: #2a1515; border: 1px solid #ff4a4a; color: #ffb3b3; border-radius: 10px;">
                <ul class="mb-0 px-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="text-light small mb-2">اسم الخدمة <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="مثلاً: تصميم ويب" required>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="text-light small mb-2">الأيقونة (إيموجي أو كود)</label>
                    <input type="text" name="icon" value="{{ old('icon') }}" class="form-control" placeholder="مثلاً: 💻">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="text-light small mb-2">الحد الأدنى للأيام للتنفيذ <span class="text-danger">*</span></label>
                    <input type="number" name="min_days_required" value="{{ old('min_days_required', 1) }}" min="1" class="form-control" placeholder="أيام" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="text-light small mb-2">وصف الخدمة</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="اكتب تفاصيل ومميزات الخدمة هنا...">{{ old('description') }}</textarea>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="background-color: #40E0D0; border: none; color: #2c3e50; font-weight: bold;">
                حفظ الخدمة 💾
            </button>
        </form>
    </div>
</div>
@endsection