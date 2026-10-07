<header class="navbar" id="mainNavbar">
    <div class="nav-container">
        <!-- LOGO -->
        <a href="{{ route('home') }}" class="logo-area" style="text-decoration: none;">
            <img src="{{ asset('assets/images/logo.png') }}" class="main-logo" alt="CreativeHub Logo">
            <div class="logo-text">
                <span>Creative</span><b>Hub</b>
            </div>
        </a>

        <!-- MENU -->
        <div class="menu" id="navMenu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                Beranda
            </a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">
                Layanan
            </a>
            <a href="{{ route('portfolio') }}" class="{{ request()->routeIs('portfolio') ? 'active' : '' }}">
                Portofolio
            </a>
            <a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">
                Harga
            </a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                Kontak
            </a>
            <a href="{{ route('contact') }}" class="mobile-cta-btn">
                Pesan Sekarang
            </a>
        </div>

        <!-- RIGHT ACTION & MOBILE TOGGLE -->
        <div class="nav-actions">
            <a href="{{ route('contact') }}" class="nav-button">
                Pesan Sekarang
            </a>
            <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle Menu">
                <i class="fa-solid fa-bars" id="toggleIcon"></i>
            </button>
        </div>
    </div>
</header>