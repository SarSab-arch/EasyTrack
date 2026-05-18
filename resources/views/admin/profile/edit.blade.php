@extends('layouts.admin')

@section('content')
<div class="container mt-4" style="direction: rtl; text-align: right;">
    
    @if ($errors->any())
        <div class="alert alert-danger border-0 py-2.5 small mb-3" style="background-color: #2a1515; border: 1px solid #ff4a4a; color: #ffb3b3; border-radius: 10px;">
            <ul class="mb-0 px-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card bg-dark text-white border-info" style="border-radius: 15px;">
        <div class="card-header border-info bg-transparent py-3">
            <h4 class="mb-0 text-info fw-bold">👤 تعديل الملف الشخصي</h4>
        </div>
        <div class="card-body p-4">
            
            @if(session('success'))
                <div class="alert alert-success border-0 py-2 small mb-4" style="background-color: #152a1e; border: 1px solid #4aff80; color: #b3ffcc; border-radius: 10px;">
                    🔑 {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small text-white-50">الاسم الحالي <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control bg-secondary text-white" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label small text-white-50">البريد الإلكتروني <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control bg-secondary text-white" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <hr class="border-secondary my-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-lock text-info me-2"></i>
                    <p class="text-info small mb-0 fw-semibold">تحديث أمان الحساب (اترك الحقول فارغة إذا كنت لا تريد تغيير كلمة المرور)</p>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small text-white-50">كلمة المرور الجديدة</label>
                        <input type="password" name="password" class="form-control bg-secondary text-white" placeholder="••••••••">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label small text-white-50">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" name="password_confirmation" class="form-control bg-secondary text-white" placeholder="••••••••">
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-info text-dark fw-bold px-4">
                        <i class="fas fa-save"></i> حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection