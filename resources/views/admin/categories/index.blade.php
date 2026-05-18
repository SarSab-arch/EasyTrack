@extends('layouts.admin')

@section('content')
<div class="custom-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: #40E0D0;">قائمة الخدمات الحالية 🛠️</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="background-color: #40E0D0; border: none; color: #2c3e50; font-weight: bold;">إضافة خدمة جديدة +</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success py-2 small mb-3" style="background-color: #152a1e; border: 1px solid #4aff80; color: #b3ffcc; border-radius: 10px;">
            🔑 {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>الأيقونة</th>
                    <th>اسم الخدمة</th>
                    <th>الوصف</th>
                    <th>الحد الأدنى للتنفيذ</th> 
                    <th class="text-center">العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td style="font-size: 1.5rem;">{{ $category->icon ?? '🛠️' }}</td>
                    <td class="fw-bold">{{ $category->name }}</td>
                    <td>
                        <span class="text-muted" title="{{ $category->description }}">
                            {{ Str::limit($category->description, 50, '...') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-secondary px-2 py-1.5">{{ $category->min_days_required }} أيام</span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning fw-bold">تعديل</a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('تنبيــه: هل أنت متأكد من حذف هذه الخدمة؟ قد يؤثر ذلك على الطلبات المرتبطة بها!')">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        ⚠️ لا توجد أي خدمات مضافة حالياً في النظام.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection