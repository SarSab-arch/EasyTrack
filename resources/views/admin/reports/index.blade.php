@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="direction: rtl; text-align: right;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white fw-bold">التقارير والإحصائيات 📊</h2>
        <button class="btn btn-outline-info btn-sm px-3" onclick="window.print()">
            <i class="fas fa-print"></i> طباعة التقرير الشامل
        </button>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="custom-card text-center mb-4 p-4" style="background-color: #161616; border: 1px solid #06b6d4; border-radius: 15px;">
                <h6 class="text-light text-uppercase small fw-bold">إجمالي خدمات المنصة</h6>
                <h1 class="display-4 fw-bold text-cyan my-3">{{ $totalCategories }}</h1>
                <p class="text-success small mb-0"><i class="fas fa-chart-line"></i> تحديث فوري مستمر</p>
            </div>
            
            <div class="custom-card text-center mb-4 p-4" style="background-color: #161616; border: 1px solid rgba(255,193,7,0.3); border-radius: 15px;">
                <h6 class="text-light text-uppercase small fw-bold">أحدث العمليات المسجلة</h6>
                <h1 class="display-4 fw-bold text-warning my-3">{{ $categoriesOverTime->sum('count') }}</h1>
                <p class="text-light small mb-0">إجمالي مدخلات السجل الزمني</p>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="custom-card p-4" style="background-color: #161616; border: 1px solid #333; border-radius: 15px;">
                <h5 class="text-white mb-4 fw-bold"><i class="fas fa-chart-area text-cyan"></i> المنحنى البياني لنمو الخدمات</h5>
                <div style="position: relative; height:220px; width:100%">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="custom-card p-4" style="background-color: #161616; border: 1px solid #333; border-radius: 15px;">
                <h5 class="text-white mb-4 fw-bold"><i class="fas fa-history text-info"></i> سجل النشاط الزمني المفصل</h5>
                <div class="table-responsive">
                    <table class="table table-dark table-hover table-borderless align-middle mb-0">
                        <thead>
                            <tr class="text-muted border-bottom border-secondary">
                                <th>التاريخ واليوم</th>
                                <th>نوع العملية وحجم النشاط</th>
                                <th class="text-center">حالة السجل الإحصائي</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categoriesOverTime as $report)
                            <tr>
                                <td class="fw-semibold text-white-50">{{ $report->date }}</td>
                                <td>
                                    <span class="text-cyan fw-bold">+ {{ $report->count }}</span> خدمة جديدة تم حقنها بالنظام
                                </td>
                                <td class="text-center">
                                    @if($report->count > 0)
                                        <span class="badge bg-soft-cyan text-cyan px-3 py-1.5"><i class="fas fa-check-circle"></i> تم التحديث (مؤرشف)</span>
                                    @else
                                        <span class="badge bg-soft-secondary text-muted px-3 py-1.5"><i class="fas fa-minus-circle"></i> مستقر</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">⚠️ لا توجد بيانات مسجلة في التقرير الزمني بعد.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-soft-cyan { background: rgba(6, 182, 212, 0.1); }
    .bg-soft-secondary { background: rgba(100, 116, 139, 0.1); }
    .text-cyan { color: #06b6d4 !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // تجهيز بيانات الجداول القادمة من لارافيل وتحويلها لمصفوفات جافاسكربت
        const reportLabels = {!! json_encode($categoriesOverTime->pluck('date')) !!};
        const reportData = {!! json_encode($categoriesOverTime->pluck('count')) !!};

        const ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'line', // منحنى بياني خطي رشيق
            data: {
                labels: reportLabels,
                datasets: [{
                    label: 'الخدمات المضافة',
                    data: reportData,
                    borderColor: '#06b6d4',
                    backgroundColor: 'rgba(6, 182, 212, 0.05)',
                    borderWidth: 3,
                    tension: 0.4, // لجعل المنحنى ناعماً وانسيابياً
                    fill: true,
                    pointBackgroundColor: '#06b6d4',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // إخفاء الدليل العلوي لتوفير مساحة ونظافة بصرية
                },
                scales: {
                    x: { ticks: { color: '#64748b' }, grid: { display: false } },
                    y: { 
                        ticks: { color: '#64748b', stepSize: 1 },
                        grid: { color: 'rgba(255, 255, 255, 0.05)' }
                    }
                }
            }
        });
    });
</script>
@endsection