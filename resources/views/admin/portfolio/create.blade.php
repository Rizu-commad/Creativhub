@extends('layouts.admin')

@section('title', 'Tambah Portofolio')
@section('page-title', 'Tambah Portofolio Baru')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fa-solid fa-plus-circle"></i> Tambah Portofolio</h3>
        <a href="{{ route('admin.portfolio.index') }}" class="btn-admin btn-admin-sm btn-outline-admin">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="form-admin">
            @csrf

            <div class="form-group-admin">
                <label>Judul Karya / Project *</label>
                <input type="text" name="title" class="input-admin" placeholder="Contoh: Rebranding Cafe Kopi" value="{{ old('title') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group-admin">
                    <label>Nama Klien</label>
                    <input type="text" name="client_name" class="input-admin" placeholder="Contoh: Kopi Senja" value="{{ old('client_name') }}">
                </div>
                <div class="form-group-admin">
                    <label>Kategori</label>
                    <input type="text" name="category" class="input-admin" placeholder="Contoh: Branding, Video Editing" value="{{ old('category') }}">
                </div>
            </div>

            <div class="form-group-admin">
                <label>Deskripsi Project</label>
                <textarea name="description" class="textarea-admin" placeholder="Ceritakan sedikit tentang project ini...">{{ old('description') }}</textarea>
            </div>

            <div class="form-group-admin">
                <label>Media / Hasil Project (Gambar / Video)</label>
                <input type="file" name="image" class="input-admin" accept="image/*,video/*,.pdf">
                <small style="color: var(--slate-400); margin-top: 6px; display: block;">Format: JPG, PNG, WebP, MP4, MOV, AVI, MKV, PDF — Maksimal 1 GB</small>
                @error('image')
                    <small style="color: #ef4444; margin-top: 4px; display: block;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group-admin">
                    <label>Urutan Tampil</label>
                    <input type="number" name="sort_order" class="input-admin" placeholder="0" value="{{ old('sort_order', 0) }}" style="max-width: 120px;">
                </div>
                <div class="form-group-admin" style="display:flex; align-items:flex-end; padding-bottom: 12px;">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_active" value="1" class="checkbox-admin" id="isActive" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="isActive">Aktif (tampil di website)</label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fa-solid fa-save"></i> Simpan Portofolio
                </button>
                <a href="{{ route('admin.portfolio.index') }}" class="btn-admin btn-outline-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
