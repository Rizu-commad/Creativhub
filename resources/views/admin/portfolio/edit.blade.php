@extends('layouts.admin')

@section('title', 'Edit Portofolio')
@section('page-title', 'Edit Portofolio')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fa-solid fa-pen-to-square"></i> Edit Portofolio</h3>
        <a href="{{ route('admin.portfolio.index') }}" class="btn-admin btn-admin-sm btn-outline-admin">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.portfolio.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="form-admin">
            @csrf @method('PUT')

            <div class="form-group-admin">
                <label>Judul Karya / Project *</label>
                <input type="text" name="title" class="input-admin" value="{{ old('title', $portfolio->title) }}" required>
            </div>

            <div class="form-row">
                <div class="form-group-admin">
                    <label>Nama Klien</label>
                    <input type="text" name="client_name" class="input-admin" value="{{ old('client_name', $portfolio->client_name) }}">
                </div>
                <div class="form-group-admin">
                    <label>Kategori</label>
                    <input type="text" name="category" class="input-admin" value="{{ old('category', $portfolio->category) }}">
                </div>
            </div>

            <div class="form-group-admin">
                <label>Deskripsi Project</label>
                <textarea name="description" class="textarea-admin">{{ old('description', $portfolio->description) }}</textarea>
            </div>

            <div class="form-group-admin">
                <label>Media / Hasil Project (Gambar / Video)</label>
                @if($portfolio->image)
                    <div class="img-preview-box" style="margin-bottom: 12px;">
                        @if(in_array(pathinfo($portfolio->image, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi', 'mkv']))
                            <video width="100%" height="200" controls>
                                <source src="{{ Storage::url($portfolio->image) }}" type="video/{{ pathinfo($portfolio->image, PATHINFO_EXTENSION) }}">
                                Browser Anda tidak mendukung video.
                            </video>
                        @elseif(in_array(pathinfo($portfolio->image, PATHINFO_EXTENSION), ['pdf']))
                            <a href="{{ Storage::url($portfolio->image) }}" target="_blank" class="btn-admin btn-outline-admin">Lihat Dokumen PDF</a>
                        @else
                            <img src="{{ Storage::url($portfolio->image) }}" alt="Preview" style="max-height: 200px;">
                        @endif
                    </div>
                    <div class="form-hint" style="margin-bottom: 12px;">Biarkan kosong jika tidak ingin mengganti file.</div>
                @endif
                <input type="file" name="image" class="input-admin" accept="image/*,video/*,.pdf">
                <small style="color: var(--slate-400); margin-top: 6px; display: block;">Format: JPG, PNG, WebP, MP4, MOV, AVI, MKV, PDF — Maksimal 1 GB</small>
                @error('image')
                    <small style="color: #ef4444; margin-top: 4px; display: block;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group-admin">
                    <label>Urutan Tampil</label>
                    <input type="number" name="sort_order" class="input-admin" value="{{ old('sort_order', $portfolio->sort_order) }}" style="max-width: 120px;">
                </div>
                <div class="form-group-admin" style="display:flex; align-items:flex-end; padding-bottom: 12px;">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_active" value="1" class="checkbox-admin" id="isActive" {{ old('is_active', $portfolio->is_active) ? 'checked' : '' }}>
                        <label for="isActive">Aktif (tampil di website)</label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.portfolio.index') }}" class="btn-admin btn-outline-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
