@extends('layouts.app')

@section('title', 'Layanan Kami')

@section('content')
<section class="page-header">
    <div class="page-header-container">
        <div class="badge">OUR SERVICES</div>
        <h1>Layanan <span>Kreatif Digital</span></h1>
        <p>Solusi lengkap pembuatan konten profesional untuk melejitkan bisnis dan brand kamu.</p>
    </div>
</section>

<section class="services-page">
    <div class="services-container">
        <div class="services-detail-grid">
            @forelse($services as $service)
            <div class="service-detail-card">
                <div class="service-icon"><i class="{{ $service->icon ?? 'fa-solid fa-star' }}"></i></div>
                <h3>{{ $service->name }}</h3>
                <p>{{ $service->description }}</p>
                @if($service->features && count($service->features) > 0)
                <ul class="service-features">
                    @foreach($service->features as $feature)
                    <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                    @endforeach
                </ul>
                @endif
                <a href="{{ route('pricing') }}" class="btn-service">Lihat Paket</a>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center;">
                <p>Belum ada layanan yang ditambahkan dari admin.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
