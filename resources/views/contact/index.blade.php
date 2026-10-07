@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<section class="page-header">
    <div class="page-header-container">
        <div class="badge">GET IN TOUCH</div>
        <h1>Hubungi <span>CreativeHub</span></h1>
        <p>Siap mengubah ide kreatifmu menjadi kenyataan? Tim kami siap membantumu kapan saja.</p>
    </div>
</section>

<section class="contact-page">
    <div class="contact-container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info-card">
                <h3>Mari Berdiskusi</h3>
                <p>Konsultasikan kebutuhan visual dan konten bisnismu secara gratis bersama tim ahli kami.</p>

                <div class="info-items">
                    <div class="info-item">
                        <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <h4>Email</h4>
                            <p>creativehub@gmail.com</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fa-brands fa-whatsapp"></i></div>
                        <div>
                            <h4>WhatsApp</h4>
                            <p>+62 857-2682-0420</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <h4>Lokasi Studio</h4>
                            <p>Jawa Tengah, Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-card">
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Email / No. WhatsApp</label>
                        <input type="text" name="contact_info" class="form-control" placeholder="Email atau nomor WA aktif" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Pilihan Layanan</label>
                        <select class="form-select" name="service" id="serviceSelect">
                            <option value="Desain Feed Media Sosial">Desain Feed Media Sosial (Rp 10.000)</option>
                            <option value="Desain Poster">Desain Poster (Rp 20.000)</option>
                            <option value="Editing Video">Editing Video (Rp 25.000)</option>
                            <option value="Pembuatan Caption Promosi">Pembuatan Caption Promosi (Rp 8.000)</option>
                            <option value="Pembuatan Template">Pembuatan Template (Rp 30.000)</option>
                            <option value="Desain Logo">Desain Logo (Rp 20.000)</option>
                            <option value="Kebutuhan Lainnya">Kebutuhan Lainnya (Custom)</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Metode Pembayaran</label>
                        <select class="form-select" name="payment_method" required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            <option value="QRIS (All Payment)">QRIS (Gopay/OVO/Dana/ShopeePay dll)</option>
                            <option value="Transfer Bank BCA">Transfer Bank BCA</option>
                            <option value="Transfer Bank Mandiri">Transfer Bank Mandiri</option>
                            <option value="Transfer Bank BNI">Transfer Bank BNI</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label>Pesan / Brief Singkat</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Jelaskan kebutuhan project Anda..."></textarea>
                    </div>
                    <button type="submit" class="btn-primary w-100">Kirim Pesan & Lanjut ke WhatsApp</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
