@extends('layouts.admin')

@section('title', 'Kelola Layanan')
@section('page-title', 'Daftar Layanan')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fa-solid fa-layer-group"></i> Daftar Layanan</h3>
        <a href="{{ route('admin.services.create') }}" class="btn-admin btn-admin-primary">
            <i class="fa-solid fa-plus"></i> Tambah Layanan
        </a>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        @if($services->count())
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Icon</th>
                    <th>Nama Layanan</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $i => $service)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><i class="{{ $service->icon }}" style="font-size: 20px; color: var(--purple-400);"></i></td>
                    <td><strong style="color: #fff;">{{ $service->name }}</strong></td>
                    <td style="color: var(--slate-400); max-width: 300px;">{{ Str::limit($service->description, 60) }}</td>
                    <td>
                        @if($service->is_active)
                            <span class="badge-status badge-active">Aktif</span>
                        @else
                            <span class="badge-status badge-inactive">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn-admin btn-admin-sm btn-edit">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
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
            <i class="fa-solid fa-layer-group"></i>
            <h3>Belum ada layanan</h3>
            <p>Tambahkan layanan pertama untuk ditampilkan di website.</p>
            <a href="{{ route('admin.services.create') }}" class="btn-admin btn-admin-primary">
                <i class="fa-solid fa-plus"></i> Tambah Layanan
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
