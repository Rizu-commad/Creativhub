<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Admin CreativeHub</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}?v={{ time() }}">
</head>
<body>
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                <div class="brand-text">
                    <span>Creative</span><b>Hub</b>
                </div>
            </a>
            <button class="sidebar-close" id="sidebarClose">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">MENU UTAMA</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group"></i>
                <span>Layanan</span>
            </a>
            <a href="{{ route('admin.pricings.index') }}" class="nav-link {{ request()->routeIs('admin.pricings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-tags"></i>
                <span>Harga</span>
            </a>
            <a href="{{ route('admin.portfolio.index') }}" class="nav-link {{ request()->routeIs('admin.portfolio.*') ? 'active' : '' }}">
                <i class="fa-solid fa-images"></i>
                <span>Portofolio</span>
            </a>

            <div class="nav-section-label">DATA MASUK</div>

            <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fa-solid fa-envelope"></i>
                <span>Pesan Masuk</span>
            </a>

            <div class="nav-section-label">LAINNYA</div>
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Lihat Website</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Top Bar -->
        <header class="admin-topbar">
            <button class="topbar-toggle" id="sidebarToggle">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="topbar-title">
                <h1>@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="topbar-right">
                <div class="admin-avatar">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>Admin</span>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="admin-content">
            @if(session('success'))
                <div class="alert-custom alert-success-custom">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                    <button class="alert-close" onclick="this.parentElement.remove()">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-custom alert-error-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    <button class="alert-close" onclick="this.parentElement.remove()">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');
        const closeBtn = document.getElementById('sidebarClose');

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('show');
        }
        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        }

        toggleBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);

        // Auto-dismiss alerts
        document.querySelectorAll('.alert-custom').forEach(el => {
            setTimeout(() => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 300);
            }, 4000);
        });
    </script>
    @yield('scripts')
</body>
</html>
