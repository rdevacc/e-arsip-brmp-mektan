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
            <a class="nav-link {{ request()->segment(2) === 'archive' ? 'active' : '' }}" href="{{route('archive-index')}}">
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

        <li class="nav-heading">Super Admin</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) === 'archive-access-level' ? 'active' : '' }}" href="{{route('archive-access-level.index') }}">
                <i class="bi bi-grid"></i>
                <span>Level Akses Arsip</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) === 'archive-condition' ? 'active' : '' }}" href="{{route('archive-condition.index') }}">
                <i class="bi bi-grid"></i>
                <span>Kondisi Arsip</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) === 'archive-development-level' ? 'active' : '' }}" href="{{route('archive-development-level.index') }}">
                <i class="bi bi-grid"></i>
                <span>Tingkat Perkembangan Arsip</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) === 'final-depreciation-action' ? 'active' : '' }}" href="{{route('final-depreciation-action.index') }}">
                <i class="bi bi-grid"></i>
                <span>Tindakan Penyusutan Akhir Arsip</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) === 'archive-media' ? 'active' : '' }}" href="{{route('archive-media.index') }}">
                <i class="bi bi-grid"></i>
                <span>Media Arsip</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) === 'public-access-level' ? 'active' : '' }}" href="{{route('public-access-level.index') }}">
                <i class="bi bi-grid"></i>
                <span>Tingkat Akses Publik Arsip</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) === 'quantity-unit' ? 'active' : '' }}" href="{{route('quantity-unit.index') }}">
                <i class="bi bi-grid"></i>
                <span>Satuan Kuantitas Arsip</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) === 'archive-retention' ? 'active' : '' }}" href="{{route('archive-retention.index') }}">
                <i class="bi bi-grid"></i>
                <span>Retensi Arsip</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(2) === 'security-classification' ? 'active' : '' }}" href="{{route('security-classification.index') }}">
                <i class="bi bi-grid"></i>
                <span>Klasifikasi Keamanan Arsip</span>
            </a>
        </li>
      </ul>
  </aside>
