  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Utama</li>

          {{-- <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('dashboard')}}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li> --}}

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('archive-index')}}">
                  <i class="bi bi-menu-button-wide"></i><span>Data Arsip</span></i>
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
  </aside><!-- End Sidebar-->
