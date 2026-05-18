@extends('layouts.client')

@section('title', 'الخدمات المتوفرة')

@section('content')
<section class="services-page py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-cyan"> الخدمات المتوفرة</h1>
            <p class="mb-5">نقدم مجموعة مختارة من أجود الخدمات المصممة خصيصاً لتلبية تطلعاتك وضمان تميز طلبك</p>
        </div>

        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="service-card-detailed p-4 d-flex flex-column h-100">
                    <div class="icon-box mb-3">
                        {!! $category->icon ?? '<i >⚙️</i>' !!}
                    </div>
                    <h3 class="h4 text-cyan">{{ $category->name }}</h3>
                    <p class="text-gray-400 small mb-4 flex-grow-1">{{ $category->description }}</p>
                    
                    <a href="{{ route('client.order', $category->id) }}" class="btn btn-cyan w-100 mt-auto">ابدأ مشروعك الآن</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection