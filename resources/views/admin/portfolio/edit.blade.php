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
                                <source src="{{ $portfolio->image_url }}" type="video/{{ pathinfo($portfolio->image, PATHINFO_EXTENSION) }}">
                                Browser Anda tidak mendukung video.
                            </video>
                        @elseif(in_array(pathinfo($portfolio->image, PATHINFO_EXTENSION), ['pdf']))
                            <a href="{{ $portfolio->image_url }}" target="_blank" class="btn-admin btn-outline-admin">Lihat Dokumen PDF</a>
                        @else
                            <img src="{{ $portfolio->image_url }}" alt="Preview" style="max-height: 200px; border-radius: 12px;">
                        @endif
                    </div>
                    <div class="form-hint" style="margin-bottom: 12px;">Biarkan kosong jika tidak ingin mengganti file.</div>
                @endif
                <input type="hidden" name="image_base64" id="imageBase64">
                <input type="file" name="image" class="input-admin" accept="image/*,video/*,.pdf">
                <div id="imagePreviewContainer" style="display: none; margin-top: 14px;">
                    <img id="imagePreviewImg" style="max-height: 200px; border-radius: 12px; border: 1px solid var(--border-glass); object-fit: contain;">
                    <div id="compressInfo" style="margin-top: 8px; font-size: 13px;"></div>
                </div>
                <small style="color: var(--slate-400); margin-top: 6px; display: block;">Format: JPG, PNG, WebP (otomatis dioptimasi), MP4, PDF — Maksimal 4.5 MB per file</small>
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
                <button type="submit" class="btn-admin btn-admin-primary" id="btnSubmit">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.portfolio.index') }}" class="btn-admin btn-outline-admin">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.querySelector('input[name="image"]');
    const form = document.querySelector('.form-admin');
    const submitBtn = document.getElementById('btnSubmit');
    const hiddenBase64 = document.getElementById('imageBase64');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImg = document.getElementById('imagePreviewImg');
    const compressInfo = document.getElementById('compressInfo');
    let isCompressing = false;

    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) {
                hiddenBase64.value = '';
                previewContainer.style.display = 'none';
                return;
            }

            if (file.type.startsWith('image/')) {
                isCompressing = true;
                compressInfo.innerHTML = `<span style="color:var(--gold-400); font-weight:600;"><i class="fa-solid fa-spinner fa-spin"></i> Sedang mengoptimasi gambar...</span>`;
                previewContainer.style.display = 'block';

                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = new Image();
                    img.onload = function() {
                        const canvas = document.createElement('canvas');
                        let width = img.width;
                        let height = img.height;
                        const maxDim = 1200;

                        if (width > maxDim || height > maxDim) {
                            if (width > height) {
                                height = Math.round((height * maxDim) / width);
                                width = maxDim;
                            } else {
                                width = Math.round((width * maxDim) / height);
                                height = maxDim;
                            }
                        }

                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);

                        const dataUrl = canvas.toDataURL('image/webp', 0.80);
                        hiddenBase64.value = dataUrl;
                        isCompressing = false;

                        const origSize = (file.size / (1024 * 1024)).toFixed(2);
                        const newSize = Math.round((dataUrl.length * 3) / 4 / 1024);

                        previewImg.src = dataUrl;
                        compressInfo.innerHTML = `<span style="color:#10b981; font-weight:600;"><i class="fa-solid fa-circle-check"></i> Foto berhasil dioptimasi (${origSize} MB &rarr; ${newSize} KB). Siap simpan super cepat!</span>`;
                    };
                    img.src = event.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                hiddenBase64.value = '';
                previewContainer.style.display = 'none';
                if (file.size > 4 * 1024 * 1024) {
                    alert('File ' + (file.size / (1024 * 1024)).toFixed(1) + ' MB terlalu besar! Batas maksimal server adalah 4 MB per file.');
                    fileInput.value = '';
                }
            }
        });
    }

    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            if (isCompressing) {
                e.preventDefault();
                alert('Gambar sedang dioptimasi, mohon tunggu 1-2 detik...');
                return;
            }

            // CRITICAL: Strip the name attribute so the browser does NOT send the multi-megabyte raw file!
            // Only the lightweight compressed base64 is sent, avoiding Vercel 413 FUNCTION_PAYLOAD_TOO_LARGE!
            if (hiddenBase64.value && fileInput) {
                fileInput.removeAttribute('name');
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan... Mohon tunggu';
        });
    }
});
</script>
@endsection
