@extends('layouts.app')

@section('title', 'Daftar Harga Per Item')

@section('content')
<section class="page-header">
    <div class="page-header-container">
        <div class="badge">TRANSPARENT PRICING</div>
        <h1>Daftar Harga <span>Per Item</span></h1>
        <p>Harga terjangkau dan fleksibel tanpa komitmen paket bulanan. Bayar sesuai kebutuhan layanan kamu!</p>
    </div>
</section>

<section class="pricing-page">
    <div class="pricing-container">
        <div class="item-pricing-grid">
            @forelse($pricings as $pricing)
            <div class="pricing-item-card {{ $pricing->is_popular ? 'featured-item' : '' }}">
                @if($pricing->is_popular)
                <div class="badge-pop">POPULAR</div>
                @endif
                <div class="card-header-row">
                    <div class="item-icon">
                        <i class="{{ $pricing->icon }}"></i>
                    </div>
                    <div class="item-price-tag">
                        <span class="price-amount">Rp {{ number_format($pricing->price, 0, ',', '.') }}</span>
                        <span class="price-unit">{{ $pricing->price_unit }}</span>
                    </div>
                </div>
                <div class="card-body-content">
                    <h3>{{ $pricing->name }}</h3>
                    <p>{{ $pricing->description }}</p>
                </div>
                <div class="card-footer-action">
                    <a href="{{ route('contact') }}?service={{ urlencode($pricing->name) }}" class="btn-item-order {{ $pricing->is_popular ? 'btn-featured' : '' }}">
                        Pesan Sekarang <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                <p>Belum ada harga yang ditambahkan.</p>
            </div>
            @endforelse
        </div>

        <!-- Summary Table Card -->
        <div class="pricing-summary-card">
            <div class="summary-header">
                <h3><i class="fa-solid fa-list-check"></i> Ringkasan Harga Per Layanan</h3>
                <p>Seluruh harga di bawah ini adalah harga jual bersih per-item tanpa biaya tersembunyi.</p>
            </div>
            <div class="table-responsive">
                <table class="custom-pricing-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">No</th>
                            <th>Jenis Layanan</th>
                            <th style="text-align: right;">Harga Jual Per Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pricings as $index => $pricing)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $pricing->name }}</strong></td>
                            <td class="table-price">Rp {{ number_format($pricing->price, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center;">Data belum tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
