<nav class="navbar navbar-expand-lg sticky-top navbar-wrapper py-3">
  <div class="container">
    <a class="navbar-brand text-logo d-flex align-items-center gap-2" href="{{ route('home') }}">
      <img src="{{ asset('favicon.svg') }}" alt="IndorePlants Logo" width="38" height="38" class="logo-badge">
      <span>Indore<span class="text-normal">Plants</span></span>
    </a>
    <button class="navbar-toggler border-0 text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa-solid fa-bars fs-3"></i>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}#about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}#popular">Popular Plants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}#reviews">Reviews</a>
        </li>

        @auth
          @if(auth()->user()->isAdmin())
            <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
              <a class="btn btn-outline-warning rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1 small" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge text-warning"></i> Admin Panel
              </a>
            </li>
          @else
            <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
              <a class="btn btn-outline-light rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1 small" href="{{ route('account.orders') }}">
                <i class="fa-solid fa-box text-warning"></i> My Orders
              </a>
            </li>
          @endif

          <li class="nav-item dropdown ms-lg-2 mt-2 mt-lg-0">
            <button class="btn btn-light rounded-pill px-3 py-1 dropdown-toggle d-flex align-items-center gap-2 small" data-bs-toggle="dropdown">
              <i class="fa-solid fa-circle-user text-success"></i>
              <span class="fw-semibold">{{ Str::limit(auth()->user()->name, 12) }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
              @if(auth()->user()->isAdmin())
                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge me-2 text-warning"></i> Dashboard</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.plants.create') }}"><i class="fa-solid fa-plus me-2 text-success"></i> Add Plant</a></li>
              @else
                <li><a class="dropdown-item" href="{{ route('account.orders') }}"><i class="fa-solid fa-box me-2 text-primary"></i> Order History</a></li>
              @endif
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
          </li>
        @else
          <li class="nav-item ms-lg-3 mt-3 mt-lg-0 d-flex gap-2">
            <a class="btn btn-outline-light rounded-pill px-3 py-1 small" href="{{ route('login') }}">
              <i class="fa-solid fa-user me-1"></i> Sign In
            </a>
            <a class="btn btn-nav-action d-inline-flex align-items-center gap-1 small" href="{{ route('register') }}">
              Register
            </a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
