<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Pricing;

class CreativeHubSeeder extends Seeder
{
    /**
     * Seed the application's database with CreativeHub sample data.
     */
    public function run(): void
    {
        // =====================
        // SERVICES (4 Layanan Utama Sesuai Poster)
        // =====================
        Service::truncate();

        $services = [
            [
                'name' => 'Pengelolaan Sosial Media',
                'description' => 'Perancangan konten, penjadwalan, hingga interaksi untuk melejitkan performa akun bisnis kamu.',
                'icon' => 'fa-solid fa-share-nodes',
                'price' => 10000,
                'price_unit' => '/ item',
                'features' => ['Perancangan Konten', 'Penjadwalan Posting', 'Interaksi & Engagement', 'Analisis Insight', 'Strategi Konten'],
                'is_popular' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Desain Grafis',
                'description' => 'Poster, banner, katalog, logo, dan materi visual promosi lainnya berkualitas tinggi.',
                'icon' => 'fa-solid fa-palette',
                'price' => 20000,
                'price_unit' => '/ desain',
                'features' => ['Desain Poster', 'Desain Banner', 'Desain Katalog', 'Desain Logo', 'Layout Profesional'],
                'is_popular' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Pembuatan Konten',
                'description' => 'Foto, video, dan editing yang berkualitas untuk meningkatkan daya tarik brand kamu.',
                'icon' => 'fa-solid fa-video',
                'price' => 25000,
                'price_unit' => '/ konten',
                'features' => ['Foto Produk', 'Video Promosi', 'Editing Video', 'Color Grading', 'Subtitle & Text'],
                'is_popular' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Lainnya',
                'description' => 'Konsultasi branding dan kebutuhan kreativitas custom lainnya sesuai kebutuhan bisnis.',
                'icon' => 'fa-solid fa-lightbulb',
                'price' => 0,
                'price_unit' => '',
                'features' => ['Konsultasi Branding', 'Strategi Marketing', 'Kebutuhan Kreatif Custom', 'Diskusi Gratis', 'Solusi Fleksibel'],
                'is_popular' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // =====================
        // PRICINGS (berdasarkan Tabel 3 Harga Pokok Penjualan Per-item)
        // =====================
        Pricing::truncate();

        $pricings = [
            [
                'name' => 'Desain Feed Media Sosial',
                'description' => 'Desain konten feed media sosial yang menarik dan engaging.',
                'icon' => 'fa-brands fa-instagram',
                'price' => 10000,
                'price_unit' => '/ slide',
                'is_popular' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Desain Poster',
                'description' => 'Poster digital profesional untuk promosi event atau produk.',
                'icon' => 'fa-solid fa-image',
                'price' => 20000,
                'price_unit' => '/ desain',
                'is_popular' => false,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Editing Video',
                'description' => 'Edit video pendek profesional untuk sosmed atau promosi.',
                'icon' => 'fa-solid fa-film',
                'price' => 25000,
                'price_unit' => '/ video',
                'is_popular' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Pembuatan Caption Promosi',
                'description' => 'Caption promosi kreatif dan persuasif siap posting.',
                'icon' => 'fa-solid fa-pen-fancy',
                'price' => 8000,
                'price_unit' => '/ caption',
                'is_popular' => false,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Pembuatan Template',
                'description' => 'Template desain editable untuk kebutuhan konten rutin.',
                'icon' => 'fa-solid fa-object-group',
                'price' => 30000,
                'price_unit' => '/ template',
                'is_popular' => true,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Desain Logo',
                'description' => 'Logo custom profesional untuk brand dan bisnis.',
                'icon' => 'fa-solid fa-pen-nib',
                'price' => 20000,
                'price_unit' => '/ logo',
                'is_popular' => false,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($pricings as $pricing) {
            Pricing::create($pricing);
        }

        // =====================
        // PORTFOLIOS
        // =====================
        Portfolio::truncate();

        $portfolios = [
            [
                'title' => 'Feed Instagram Skincare Glow',
                'description' => 'Konten feed Instagram untuk brand skincare dengan tone soft dan clean.',
                'category' => 'Desain Feed',
                'client_name' => 'Glow Skincare',
                'image' => null,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Poster Event Music Festival',
                'description' => 'Desain poster promosi untuk event musik tahunan.',
                'category' => 'Desain Poster',
                'client_name' => 'SoundWave Fest',
                'image' => null,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Video Promosi Resto Senja',
                'description' => 'Video pendek promosi menu baru untuk restoran.',
                'category' => 'Editing Video',
                'client_name' => 'Senja Resto',
                'image' => null,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Caption Promosi Toko Online',
                'description' => 'Paket caption promosi harian untuk toko fashion online.',
                'category' => 'Caption Promosi',
                'client_name' => 'StyleKu Shop',
                'image' => null,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Template Konten Kafe Kopi',
                'description' => 'Template konten media sosial editable untuk kafe kopi lokal.',
                'category' => 'Template',
                'client_name' => 'Kedai Kopi Nusantara',
                'image' => null,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Logo Brand Fashion Lokal',
                'description' => 'Desain logo modern dan minimalis untuk brand fashion lokal.',
                'category' => 'Desain Logo',
                'client_name' => 'UrbanWear ID',
                'image' => null,
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}
