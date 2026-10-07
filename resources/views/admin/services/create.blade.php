@extends('layouts.admin')

@section('title', 'Tambah Layanan')
@section('page-title', 'Tambah Layanan Baru')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fa-solid fa-plus-circle"></i> Tambah Layanan</h3>
        <a href="{{ route('admin.services.index') }}" class="btn-admin btn-admin-sm btn-outline-admin">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.services.store') }}" method="POST" class="form-admin">
            @csrf

            <div class="form-group-admin">
                <label>Nama Layanan *</label>
                <input type="text" name="name" class="input-admin" placeholder="Contoh: Desain Feed Media Sosial" value="{{ old('name') }}" required>
            </div>

            <div class="form-group-admin">
                <label>Deskripsi</label>
                <textarea name="description" class="textarea-admin" placeholder="Deskripsi singkat layanan...">{{ old('description') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group-admin">
                    <label>Harga (Rp) *</label>
                    <input type="number" name="price" class="input-admin" placeholder="10000" value="{{ old('price', 0) }}" required min="0">
                </div>
                <div class="form-group-admin">
                    <label>Satuan Harga</label>
                    <input type="text" name="price_unit" class="input-admin" placeholder="/ desain" value="{{ old('price_unit', '/ item') }}">
                </div>
            </div>

            <div class="form-group-admin">
                <label>Icon (Font Awesome class)</label>
                <input type="text" name="icon" class="input-admin" placeholder="fa-solid fa-camera" value="{{ old('icon', 'fa-solid fa-star') }}">
                <div class="form-hint">Contoh: fa-solid fa-camera, fa-solid fa-video, fa-solid fa-pen</div>
            </div>

            <div class="form-group-admin">
                <label>Fitur (satu per baris)</label>
                <textarea name="features" class="textarea-admin" rows="5" placeholder="Desain Feed & Story High Quality&#10;Video Short / Reels Content&#10;Caption & Hashtag Optimization">{{ old('features') }}</textarea>
                <div class="form-hint">Ketik satu fitur per baris. Akan ditampilkan sebagai checklist.</div>
            </div>

            <div class="form-group-admin">
                <label>Urutan Tampil</label>
                <input type="number" name="sort_order" class="input-admin" placeholder="0" value="{{ old('sort_order', 0) }}" style="max-width: 120px;">
            </div>

            <div class="form-row" style="gap: 32px;">
                <div class="form-group-admin">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_active" value="1" class="checkbox-admin" id="isActive" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="isActive">Aktif (tampil di website)</label>
                    </div>
                </div>
                <div class="form-group-admin">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_popular" value="1" class="checkbox-admin" id="isPopular" {{ old('is_popular') ? 'checked' : '' }}>
                        <label for="isPopular">Tandai sebagai Populer</label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fa-solid fa-save"></i> Simpan Layanan
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn-admin btn-outline-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
