<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - IndorePlants')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-bg: #052e16;
            --sidebar-hover: #0f522e;
            --accent-gold: #eab308;
            --main-bg: #f8fafc;
            --card-border: #e2e8f0;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--main-bg);
            color: #1e293b;
        }
        h1, h2, h3, h4, h5, h6, .brand-font {
            font-family: 'Outfit', sans-serif;
        }
        .admin-sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s;
        }
        .admin-main {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            padding: 24px 20px;
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar-nav {
            padding: 20px 0;
            list-style: none;
            margin: 0;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .sidebar-link:hover, .sidebar-link.active {
            color: var(--accent-gold);
            background-color: var(--sidebar-hover);
            border-left: 4px solid var(--accent-gold);
        }
        .admin-header {
            background: #fff;
            border-bottom: 1px solid var(--card-border);
            padding: 16px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-content {
            padding: 30px;
            flex: 1;
        }
        .stat-card {
            background: #fff;
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 24px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }
        .card-custom {
            background: #fff;
            border: 1px solid var(--card-border);
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        @media (max-width: 991px) {
            .admin-sidebar {
                margin-left: -260px;
            }
            .admin-sidebar.show {
                margin-left: 0;
            }
            .admin-main {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('favicon.svg') }}" alt="Logo" width="32" height="32">
            <span>Indore<span style="color: var(--accent-gold);">Admin</span></span>
        </a>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.plants.index') }}" class="sidebar-link {{ request()->routeIs('admin.plants.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-seedling"></i> Plants Catalog
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i> Categories
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cart-shopping"></i> Customer Orders
                </a>
            </li>
            <li class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Storefront
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" id="sidebarToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h4 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h4>
            </div>

            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill">
                    <i class="fa-solid fa-circle text-success me-1 small"></i> Online Store Active
                </span>
                <div class="dropdown">
                    <button class="btn btn-light rounded-pill px-3 dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-circle-user text-success fs-5"></i>
                        <span class="fw-semibold">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                        <li><a class="dropdown-item" href="{{ route('home') }}" target="_blank"><i class="fa-solid fa-shop me-2 text-success"></i> Live Website</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.plants.create') }}"><i class="fa-solid fa-plus me-2 text-primary"></i> Add New Plant</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Sign Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Dynamic Content -->
        <main class="admin-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-top py-3 px-4 text-center text-muted small">
            &copy; {{ date('Y') }} IndorePlants Management Portal.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.getElementById('adminSidebar').classList.toggle('show');
        });
    </script>
    @stack('scripts')
</body>
</html>
