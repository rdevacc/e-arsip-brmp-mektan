  <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Utama</li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{route('dashboard')}}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('archive-*') ? 'active' : '' }}" href="{{route('archive-index')}}">
                  <i class="bi bi-menu-button-wide"></i>
                  <span>Data Arsip</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('report-*') ? 'active' : '' }}" href="#">
                  <i class="bi bi-file-earmark-text"></i>
                  <span>Laporan</span>
              </a>
          </li>

          {{-- @canany(['isSuperAdmin', 'isAdmin']) --}}
          {{-- <li class="nav-heading">Super Admin</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('user-index')}}">
                  <i class="bi bi-people"></i>
                  <span>Users</span>
              </a>
          </li>
         
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('kelompok-index')}}">
                  <i class="bi bi-diagram-2"></i>
                  <span>Kelompok</span>
              </a>
          </li>
         
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('subkelompok-index')}}">
                  <i class="bi bi-diagram-3"></i>
                  <span>Subkelompok</span>
              </a>
          </li> --}}
          {{-- @endcanany
          @can('isSuperAdmin') --}}
          {{-- <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('role-index')}}">
                  <i class="bi bi-shield-check"></i>
                  <span>Roles</span>
              </a>
          </li> --}}
          {{-- @endcan --}}
      </ul>
  </aside>
