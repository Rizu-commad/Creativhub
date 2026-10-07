@extends('layouts.app')


@section('title','Home')


@section('content')



<section class="hero">


<div class="hero-container">



<div class="hero-content">


<div class="badge">

CREATIVE DIGITAL AGENCY

</div>



<h1>

Solusi Kreatif
<br>

Untuk Semua
<br>

<span>
Kebutuhan Kontenmu
</span>


</h1>



<p>

CreativeHub membantu brand, bisnis,
dan personal membuat konten digital
yang menarik dan profesional.

</p>



<div class="hero-btn">


<a href="{{ route('contact') }}" class="btn-primary">

Mulai Project

</a>



<a href="{{ route('portfolio') }}" class="btn-outline">

Lihat Portfolio

</a>


</div>


</div>





<div class="hero-image">


<img src="{{asset('assets/images/hero.png')}}">


</div>


</div>


</section>





<section class="services">


<div class="section-title">

<h2>

Layanan Kami

</h2>


<p>

Berbagai kebutuhan konten dalam satu tempat

</p>

</div>





<div class="service-grid">

@forelse($services as $service)
<div class="service-card">
<i class="{{ $service->icon ?? 'fa-solid fa-star' }}"></i>
<h3>{{ $service->name }}</h3>
<p>{{ Str::limit($service->description, 100) }}</p>
</div>
@empty
<p>Belum ada layanan yang ditambahkan dari admin.</p>
@endforelse

</div>


</section>





@endsection