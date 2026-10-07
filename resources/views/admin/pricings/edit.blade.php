@extends('layouts.admin')

@section('title', 'Edit Harga')
@section('page-title', 'Edit Harga')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="fa-solid fa-pen-to-square"></i> Edit Harga</h3>
        <a href="{{ route('admin.pricings.index') }}" class="btn-admin btn-admin-sm btn-outline-admin">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.pricings.update', $pricing) }}" method="POST" class="form-admin">
            @csrf @method('PUT')

            <div class="form-group-admin">
                <label>Jenis Layanan *</label>
                <input type="text" name="name" class="input-admin" value="{{ old('name', $pricing->name) }}" required>
            </div>

            <div class="form-group-admin">
                <label>Deskripsi</label>
                <textarea name="description" class="textarea-admin">{{ old('description', $pricing->description) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group-admin">
                    <label>Harga Jual (Rp) *</label>
                    <input type="number" name="price" class="input-admin" value="{{ old('price', $pricing->price) }}" required min="0">
                </div>
                <div class="form-group-admin">
                    <label>Satuan Harga</label>
                    <input type="text" name="price_unit" class="input-admin" value="{{ old('price_unit', $pricing->price_unit) }}">
                </div>
            </div>

            <div class="form-group-admin">
                <label>Icon (Font Awesome class)</label>
                <input type="text" name="icon" class="input-admin" value="{{ old('icon', $pricing->icon) }}">
                <div class="form-hint">Contoh: fa-solid fa-camera, fa-solid fa-video, fa-solid fa-pen-nib</div>
            </div>

            <div class="form-group-admin">
                <label>Urutan Tampil</label>
                <input type="number" name="sort_order" class="input-admin" value="{{ old('sort_order', $pricing->sort_order) }}" style="max-width: 120px;">
            </div>

            <div class="form-row" style="gap: 32px;">
                <div class="form-group-admin">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_active" value="1" class="checkbox-admin" id="isActive" {{ old('is_active', $pricing->is_active) ? 'checked' : '' }}>
                        <label for="isActive">Aktif (tampil di website)</label>
                    </div>
                </div>
                <div class="form-group-admin">
                    <div class="checkbox-group">
                        <input type="checkbox" name="is_popular" value="1" class="checkbox-admin" id="isPopular" {{ old('is_popular', $pricing->is_popular) ? 'checked' : '' }}>
                        <label for="isPopular">Tandai sebagai Populer</label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-admin btn-admin-primary">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.pricings.index') }}" class="btn-admin btn-outline-admin">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
