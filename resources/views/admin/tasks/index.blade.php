@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="direction: rtl; text-align: right;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">إدارة طلبات {{ $settings->site_name ?? 'EasyTrack' }} </h2>
        <span class="badge" style="background-color: #00ced1; color: #000; font-weight: bold;">إجمالي الطلبات: {{ $tasks->count() }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success py-2 small mb-3" style="background-color: #152a1e; border: 1px solid #4aff80; color: #b3ffcc; border-radius: 10px;">
            🔑 {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-lg" style="background-color: #121212; border: 1px solid #333; border-radius: 15px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0" style="background-color: #121212;">
                    <thead style="border-bottom: 2px solid #00ced1;">
                        <tr>
                            <th class="p-3">رقم الطلب</th>
                            <th class="p-3">العميل</th>
                            <th class="p-3">الخدمة</th>
                            <th class="p-3">الموعد النهائي</th>
                            <th class="p-3">الحالة</th>
                            <th class="p-3 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                        <tr style="border-bottom: 1px solid #222; vertical-align: middle;">
                            <td class="p-3">#{{ $task->id }}</td>
                            <td class="p-3 fw-bold text-white">{{ $task->customer_name }}</td>
                            <td class="p-3">
                                <span class="text-info">{{ $task->category->name ?? 'خدمة مخصصة' }}</span>
                            </td>
                            <td class="p-3">{{ $task->deadline }}</td>
                            <td class="p-3">
                                @if($task->status == 'under_review')
                                    <span class="badge bg-warning text-dark">تحت المراجعة</span>
                                @elseif($task->status == 'in_progress')
                                    <span class="badge" style="background-color: #00ced1; color: #000;">قيد التنفيذ</span>
                                @elseif($task->status == 'completed')
                                    <span class="badge bg-success">مكتمل</span>
                                @else
                                    <span class="badge bg-danger">مرفوض</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.tasks.show', $task->id) }}" class="btn btn-sm" style="border: 1px solid #00ced1; color: #00ced1; font-weight: bold;">
                                        <i class="fas fa-eye"></i> عرض التفاصيل
                                    </a>
                                    
                                    <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('هل أنت متأكد من حذف هذا الطلب نهائياً؟')">حذف</button>
                                    </form> 
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">لا يوجد طلبات مسجلة حتى الآن</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection