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

        {{-- Menu Super Admin --}}
        @can('super-admin')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('archive-report*') ? 'active' : '' }}" href="{{route('archive-report.index')}}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Cetak Laporan Arsip</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('import-excel*') ? 'active' : '' }}" href="{{route('import-excel.index')}}">
                    <i class="bi bi-cloud-upload"></i>
                    <span>Import Data Excel</span>
                </a>
            </li>
            
            <li class="nav-heading">Super Admin</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'user' ? 'active' : '' }}" href="{{route('user.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'role' ? 'active' : '' }}" href="{{route('role.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Roles</span>
                </a>
            </li>

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

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'archive-type' ? 'active' : '' }}" href="{{route('archive-type.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Jenis Arsip</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'archive-subtype' ? 'active' : '' }}" href="{{route('archive-subtype.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Sub Jenis Arsip</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'archive-status' ? 'active' : '' }}" href="{{route('archive-status.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Status Arsip</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'work-unit' ? 'active' : '' }}" href="{{route('work-unit.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Unit Kerja</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'work-group' ? 'active' : '' }}" href="{{route('work-group.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Kelompok Kerja</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'work-team' ? 'active' : '' }}" href="{{route('work-team.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Tim Kerja</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'work-team-classification' ? 'active' : '' }}" href="{{route('work-team-classification.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Kode Klasifikasi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'archive-storage-location' ? 'active' : '' }}" href="{{route('archive-storage-location.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Lokasi Penyimpanan Arsip</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'archive-storage-place' ? 'active' : '' }}" href="{{route('archive-storage-place.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Tempat Penyimpanan Arsip</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'archive-shelf-row' ? 'active' : '' }}" href="{{route('archive-shelf-row.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Baris Tempat Penyimpanan Arsip</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'archive-box' ? 'active' : '' }}" href="{{route('archive-box.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Box Arsip</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'archive-folder' ? 'active' : '' }}" href="{{route('archive-folder.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Folder Arsip</span>
                </a>
            </li>
        @endcan
      </ul>
  </aside>
