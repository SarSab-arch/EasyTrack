@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm" style="border-top: 5px solid #00ced1;">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">إعدادات الموقع العامة</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- مهم جداً لتوجيه عملية التحديث في لارافيل --}}
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>اسم الموقع</label>
                        <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings->site_name) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>عنوان الهيرو (Hero Title)</label>
                        <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $settings->hero_title) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>عن الموقع (About Us)</label>
                    <textarea name="about_us" class="form-control" rows="4">{{ old('about_us', $settings->about_us) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>لوجو الموقع</label>
                        <input type="file" name="site_logo" class="form-control">
                        @if($settings->site_logo)
                            <div class="mt-2">
                                <small class="text-muted d-block">اللوجو الحالي المرفوع:</small>
                                <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" style="max-height: 50px;">
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label>صورة الهيرو</label>
                        <input type="file" name="hero_image" class="form-control">
                        @if($settings->hero_image)
                            <div class="mt-2">
                                <small class="text-muted d-block">صورة الهيرو الحالية المرفوعة:</small>
                                <img src="{{ asset('storage/' . $settings->hero_image) }}" alt="Hero" style="max-height: 50px;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-dark fw-bold">📧 بريد التواصل:</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings->contact_email) }}" placeholder="support@easytrack.com">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-dark fw-bold">📞 رقم الهاتف للاتصال:</label>
                        <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $settings->contact_phone) }}" placeholder="مثال: 96777xxxxxxx">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-dark fw-bold">💬 رقم الواتساب :</label>
                        <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}" placeholder="مثال: 96777xxxxxxx">
                    </div>
                </div>

                <button type="submit" class="btn text-white w-100" style="background-color: #00ced1;">حفظ التغييرات</button>
            </form>
        </div>
    </div>
</div>
@endsection