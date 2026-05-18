@extends('layouts.client')

@section('title', 'تفاصيل تتبع الطلب')

@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-4 text-white">تتبع حالة طلبك <span style="color: #00ced1;">#{{ $task->id }}</span></h2>
    
    <div class="card bg-dark text-white p-4" style="border: 1px solid #333; border-radius: 15px;">
        
        <h5 class="mb-4 text-white">
            مرحباً {{ Str::mask($task->customer_name, '*', 2) }}، إليك تحديث طلبك:
        </h5>

        @php
            $statusData = [
                'under_review' => ['percent' => 25, 'text' => 'تحت المراجعة', 'color' => '#ffc107'],
                'in_progress'  => ['percent' => 60, 'text' => 'جاري التنفيذ', 'color' => '#00ced1'],
                'completed'    => ['percent' => 100, 'text' => 'تم الإنجاز بنجاح', 'color' => '#28a745'],
                'rejected'     => ['percent' => 100, 'text' => 'نعتذر، تم رفض الطلب', 'color' => '#dc3545'],
            ];
            $current = $statusData[$task->status] ?? ['percent' => 10, 'text' => 'غير معروف', 'color' => '#ccc'];
        @endphp

        <div class="progress mb-4" style="height: 35px; background-color: #1a1a1a; border-radius: 20px; overflow: hidden; border: 1px solid #444;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                 role="progressbar" 
                 style="width: {{ $current['percent'] }}%; background-color: {{ $current['color'] }}; transition: width 1s ease-in-out;" 
                 aria-valuenow="{{ $current['percent'] }}" aria-valuemin="0" aria-valuemax="100">
                 {{ $current['percent'] }}%
            </div>
        </div>

        <h3 style="color: {{ $current['color'] }}; mb-4">{{ $current['text'] }}</h3>
        
        <div class="mt-4 p-3" style="background: #222; border-radius: 10px;">
            <p class="mb-1">نوع الخدمة: <span class="text-info">{{ $task->category->name }}</span></p>
            <p class="mb-0">تاريخ الطلب: {{ $task->created_at->format('Y-m-d') }}</p>
        </div>
    </div>
</div>
@endsection