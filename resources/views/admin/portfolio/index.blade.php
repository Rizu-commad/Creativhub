@extends('layouts.admin')

@section('title', 'Kelola Portofolio')
@section('page-title', 'Portofolio')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fa-solid fa-images"></i> Daftar Portofolio</h3>
        <a href="{{ route('admin.portfolio.create') }}" class="btn-admin btn-admin-primary">
            <i class="fa-solid fa-plus"></i> Tambah Portofolio
        </a>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        @if($portfolios->count())
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th style="width: 80px;">Gambar</th>
                    <th>Judul Karya</th>
                    <th>Klien</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($portfolios as $i => $portfolio)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        @if($portfolio->image)
                            @if(in_array(pathinfo($portfolio->image, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi', 'mkv']))
                                <div class="portfolio-thumb-placeholder" style="background:#222; color:#fff;"><i class="fa-solid fa-video"></i></div>
                            @elseif(in_array(pathinfo($portfolio->image, PATHINFO_EXTENSION), ['pdf']))
                                <div class="portfolio-thumb-placeholder" style="background:#ffebee; color:#d9534f;"><i class="fa-solid fa-file-pdf"></i></div>
                            @else
                                <img src="{{ Storage::url($portfolio->image) }}" class="portfolio-thumb" alt="Thumb" style="object-fit:cover;">
                            @endif
                        @else
                            <div class="portfolio-thumb-placeholder"><i class="fa-regular fa-image"></i></div>
                        @endif
                    </td>
                    <td><strong style="color: #fff;">{{ $portfolio->title }}</strong></td>
                    <td>{{ $portfolio->client_name ?? '-' }}</td>
                    <td>{{ $portfolio->category ?? '-' }}</td>
                    <td>
                        @if($portfolio->is_active)
                            <span class="badge-status badge-active">Aktif</span>
                        @else
                            <span class="badge-status badge-inactive">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('admin.portfolio.edit', $portfolio) }}" class="btn-admin btn-admin-sm btn-edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.portfolio.destroy', $portfolio) }}" method="POST" onsubmit="return confirm('Hapus karya ini?')">
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
            <i class="fa-solid fa-images"></i>
            <h3>Belum ada portofolio</h3>
            <p>Tambahkan karya terbaikmu untuk meyakinkan calon pelanggan.</p>
            <a href="{{ route('admin.portfolio.create') }}" class="btn-admin btn-admin-primary">
                <i class="fa-solid fa-plus"></i> Tambah Portofolio
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
