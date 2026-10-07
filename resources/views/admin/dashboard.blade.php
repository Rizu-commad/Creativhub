@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon"><i class="fa-solid fa-layer-group"></i></div>
        </div>
        <div class="stat-number">{{ $totalServices }}</div>
        <div class="stat-label">Total Layanan</div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon"><i class="fa-solid fa-images"></i></div>
        </div>
        <div class="stat-number">{{ $totalPortfolios }}</div>
        <div class="stat-label">Total Portofolio</div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon"><i class="fa-solid fa-cart-shopping"></i></div>
        </div>
        <div class="stat-number">{{ $totalOrders }}</div>
        <div class="stat-label">Total Pesanan</div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon"><i class="fa-solid fa-envelope"></i></div>
        </div>
        <div class="stat-number">{{ $totalContacts }}</div>
        <div class="stat-label">Pesan Masuk</div>
    </div>
</div>

<!-- Quick Info Row -->
<div class="two-col-grid">
    <!-- Recent Orders -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3><i class="fa-solid fa-clock-rotate-left"></i> Pesanan Terbaru</h3>
            <a href="{{ route('admin.orders.index') }}" class="btn-admin btn-admin-sm btn-outline-admin">Lihat Semua</a>
        </div>
        <div class="admin-card-body" style="padding: 0;">
            @if($recentOrders->count())
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->service_name }}</td>
                        <td><span class="badge-status badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fa-solid fa-inbox"></i>
                <p>Belum ada pesanan masuk</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3><i class="fa-solid fa-envelope-open-text"></i> Pesan Terbaru</h3>
            <a href="{{ route('admin.contacts.index') }}" class="btn-admin btn-admin-sm btn-outline-admin">Lihat Semua</a>
        </div>
        <div class="admin-card-body" style="padding: 0;">
            @if($recentContacts->count())
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Layanan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentContacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->service ?? '-' }}</td>
                        <td>
                            @if($contact->is_read)
                                <span class="badge-status badge-read">Dibaca</span>
                            @else
                                <span class="badge-status badge-unread">Baru</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fa-solid fa-envelope"></i>
                <p>Belum ada pesan masuk</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
