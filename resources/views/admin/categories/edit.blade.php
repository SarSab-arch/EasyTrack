@extends('layouts.admin')

@section('content')
<div class="container py-4" style="direction: rtl; text-align: right;">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark fw-bold">
            تعديل الخدمة: {{ $category->name }}
        </div>
        <div class="card-body">
            
            @if($errors->any())
                <div class="alert alert-danger py-2 small" style="background-color: #2a1515; border: 1px solid #ff4a4a; color: #ffb3b3; border-radius: 10px;">
                    <ul class="mb-0 px-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- مهم جداً للتعديل --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">اسم الخدمة <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">أيقونة (إيموجي)</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $category->icon) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">الحد الأدنى للأيام للتنفيذ <span class="text-danger">*</span></label>
                        <input type="number" name="min_days_required" class="form-control" value="{{ old('min_days_required', $category->min_days_required) }}" min="1" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">وصف الخدمة</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>         
            </form>
        </div>
    </div>
</div>
@endsection