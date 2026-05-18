@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="direction: rtl; text-align: right;">
    <h2 class="mb-4 text-white">مرحباً بك 👋</h2>
    
    <div class="row">
        <div class="col-md-4">
            <div class="custom-card shadow-sm text-center">
                <i class="fas fa-layer-group fa-3x text-info mb-3"></i>
                <h5 class="mb-3">الخدمات المتوفرة</h5>
                <h2 class="fw-bold text-cyan">{{ $categoriesCount }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="custom-card shadow-sm text-center">
                <i class="fas fa-tasks fa-3x text-warning mb-3"></i>
                <h5 class="mb-3">المهمات النشطة</h5>
                <h2 class="fw-bold text-warning">{{ $activeTasksCount }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="custom-card shadow-sm text-center border-success">
                <i class="fas fa-clock fa-3x text-success mb-3"></i>
                <h5 class="mb-3">تاريخ اليوم</h5>
                <h2 class="fw-bold text-white fs-4">{{ now()->format('Y-m-d') }}</h2>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="custom-card">
                <h5 class="mb-3 text-white">أحدث الخدمات المضافة</h5>
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>الخدمة</th>
                                <th>تاريخ الإضافة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestCategories as $cat)
                            <tr>
                                <td class="fw-bold text-info">{{ $cat->name }}</td>
                                <td>{{ $cat->created_at->diffForHumans() }}</td>
                                <td><span class="badge bg-info text-darkfw-bold">نشط</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">لا توجد خدمات مضافة مؤخراً</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection