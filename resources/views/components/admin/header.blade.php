<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
      <img src="{{ asset('admin/assets/img/logo-kementan.png') }}" alt="Logo">
      <span class="d-none d-lg-block" style="white-space: nowrap;">E-Arsip Mektan</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <nav class="header-nav ms-auto">
    @auth      
    <ul class="d-flex align-items-center">
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          {{-- <img src="{{ asset('admin/assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle"> --}}
          <span class="d-flex d-lg-block dropdown-toggle ps-2">{{ auth()->user()->name ?? "Account Name" }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ auth()->user()->name ?? "Account Name" }}</h6>
            <span>{{ auth()->user()->role->name ?? "Account Role" }}</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
    @endauth
    @guest
       <a class="nav-link nav-profile d-flex align-items-center pe-4" href="{{ route('login') }}">Login</a>
    @endguest
  </nav>
</header>