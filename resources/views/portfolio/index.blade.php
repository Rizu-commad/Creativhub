@extends('layouts.app')

@section('title', 'Portofolio')

@section('content')
<section class="page-header">
    <div class="page-header-container">
        <div class="badge">OUR PORTFOLIO</div>
        <h1>Portofolio <span>Karya Kami</span></h1>
        <p>Kumpulan karya kreatif pilihan yang dikerjakan khusus untuk klien kami.</p>
    </div>
</section>

<section class="portfolio-page">
    <div class="portfolio-container">
        @if($portfolios->isEmpty())
        <!-- Empty State Container -->
        <div class="portfolio-empty-state">
            <div class="empty-icon">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <h2>Portofolio Segera Hadir</h2>
            <p>
                Galeri karya terbaik kami sedang dalam tahap pengumpulan & penyusunan.<br>
                Ingin menjadi brand berikutnya yang bekerja sama dengan kami?
            </p>
            <div class="empty-action">
                <a href="{{ route('contact') }}" class="btn-primary">
                    Mulai Project Baru <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        @else
        <div class="portfolio-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
            @foreach($portfolios as $portfolio)
            <div class="portfolio-card" style="border-radius: 20px; overflow: hidden; background: var(--bg-card); border: 1px solid var(--border-glass);">
                @if($portfolio->image)
                    @if(in_array(pathinfo($portfolio->image, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi', 'mkv']))
                        <video style="width: 100%; height: 250px; object-fit: cover;" controls>
                            <source src="{{ $portfolio->image_url }}" type="video/{{ pathinfo($portfolio->image, PATHINFO_EXTENSION) }}">
                        </video>
                    @elseif(in_array(pathinfo($portfolio->image, PATHINFO_EXTENSION), ['pdf']))
                        <div style="width: 100%; height: 250px; display:flex; align-items:center; justify-content:center; background: rgba(255,255,255,0.05); color:#fff;">
                            <i class="fa-solid fa-file-pdf fa-3x" style="color:#ef4444; margin-bottom: 10px;"></i>
                            <div style="margin-left: 10px;">Dokumen PDF</div>
                        </div>
                    @else
                        <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" onclick="openLightbox('{{ $portfolio->image_url }}', '{{ addslashes($portfolio->title) }}')">
                    @endif
                @else
                    <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" onclick="openLightbox('{{ $portfolio->image_url }}', '{{ addslashes($portfolio->title) }}')">
                @endif
                <div class="portfolio-info" style="padding: 24px;">
                    <h3 style="margin: 0 0 10px 0; font-size: 1.2rem; color: #fff; font-weight: 800;">{{ $portfolio->title }}</h3>
                    <p style="margin: 0; color: var(--slate-400); font-size: 0.95rem; line-height: 1.6;">{{ $portfolio->description }}</p>
                    
                    @if($portfolio->image && in_array(pathinfo($portfolio->image, PATHINFO_EXTENSION), ['pdf']))
                        <a href="{{ $portfolio->image_url }}" target="_blank" style="display: inline-block; margin-top: 15px; color: var(--purple-400); text-decoration: none; font-weight: 600;">Buka PDF <i class="fa-solid fa-arrow-right"></i></a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal -->
<div id="portfolioLightbox" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.85); justify-content: center; align-items: center; flex-direction: column;">
    <span onclick="closeLightbox()" style="position: absolute; top: 20px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; cursor: pointer;">&times;</span>
    <img id="lightboxImg" style="max-width: 90%; max-height: 85vh; border-radius: 8px; object-fit: contain;">
    <div id="lightboxCaption" style="margin-top: 20px; color: #fff; font-size: 1.2rem; font-weight: 600;"></div>
</div>

<script>
function openLightbox(imgSrc, title) {
    document.getElementById('portfolioLightbox').style.display = 'flex';
    document.getElementById('lightboxImg').src = imgSrc;
    document.getElementById('lightboxCaption').innerText = title;
    document.body.style.overflow = 'hidden'; // prevent scrolling behind
}

function closeLightbox() {
    document.getElementById('portfolioLightbox').style.display = 'none';
    document.body.style.overflow = 'auto'; // re-enable scrolling
}
</script>
@endsection
