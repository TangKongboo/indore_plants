<nav class="navbar navbar-expand-lg sticky-top navbar-wrapper py-3">
  <div class="container">
    <a class="navbar-brand text-logo d-flex align-items-center gap-2" href="{{ route('home') }}">
      <img src="{{ asset('images/favicon.svg') }}" alt="IndorePlants Logo" width="38" height="38" class="logo-badge">
      <span>Indore<span class="text-normal">Plants</span></span>
    </a>
    <button class="navbar-toggler border-0 text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa-solid fa-bars fs-3"></i>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#popular">Popular Plants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#reviews">Reviews</a>
        </li>
        <li class="nav-item ms-lg-3 mt-3 mt-lg-0 d-flex gap-2">
          <a class="btn btn-nav-action d-inline-flex align-items-center gap-2" href="#popular">
            <i class="fa-solid fa-bag-shopping"></i> Shop Now
          </a>
          <a class="btn btn-outline-light rounded-pill px-3 d-inline-flex align-items-center gap-1 small" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-gauge text-warning"></i> Admin
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
