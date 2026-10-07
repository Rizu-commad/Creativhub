@extends('layouts.admin')

@section('title', 'Kelola Harga')
@section('page-title', 'Daftar Harga')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fa-solid fa-tags"></i> Daftar Harga Per Item</h3>
        <a href="{{ route('admin.pricings.create') }}" class="btn-admin btn-admin-primary">
            <i class="fa-solid fa-plus"></i> Tambah Harga
        </a>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        @if($pricings->count())
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Icon</th>
                    <th>Jenis Layanan</th>
                    <th>Harga Jual</th>
                    <th>Status</th>
                    <th>Populer</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pricings as $i => $pricing)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><i class="{{ $pricing->icon }}" style="font-size: 20px; color: var(--purple-400);"></i></td>
                    <td><strong style="color: #fff;">{{ $pricing->name }}</strong></td>
                    <td>
                        <span class="price-tag">
                            Rp {{ number_format($pricing->price, 0, ',', '.') }}
                            <small>{{ $pricing->price_unit }}</small>
                        </span>
                    </td>
                    <td>
                        @if($pricing->is_active)
                            <span class="badge-status badge-active">Aktif</span>
                        @else
                            <span class="badge-status badge-inactive">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        @if($pricing->is_popular)
                            <span class="badge-status badge-popular"><i class="fa-solid fa-star"></i> Populer</span>
                        @else
                            <span style="color: var(--slate-600);">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('admin.pricings.edit', $pricing) }}" class="btn-admin btn-admin-sm btn-edit">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('admin.pricings.destroy', $pricing) }}" method="POST" onsubmit="return confirm('Hapus harga ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-admin btn-admin-sm btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <i class="fa-solid fa-tags"></i>
            <h3>Belum ada harga</h3>
            <p>Tambahkan harga per item untuk ditampilkan di website.</p>
            <a href="{{ route('admin.pricings.create') }}" class="btn-admin btn-admin-primary">
                <i class="fa-solid fa-plus"></i> Tambah Harga
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
