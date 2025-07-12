<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="/home" id="home">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- Pengguna -->
    @auth
        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->routeIs('pengguna.*') ? 'active' : '' }}">
                <a class="nav-link" href="/pengguna" id="pengguna">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Pengguna</span>
                </a>
            </li>
        @endif
    @endauth

    <!-- Surat Masuk -->
    <li class="nav-item {{ request()->routeIs('suratmasuk.*') ? 'active' : '' }}">
      <a class="nav-link" href="/suratmasuk" id="suratmasuk">
        <i class="icon-envelope-letter menu-icon"></i>
        <span class="menu-title">Surat Masuk</span>
      </a>
    </li>

    <!-- Surat Keluar -->
    <li class="nav-item {{ request()->is('suratkeluar*') ? 'active' : '' }}">
      <a class="nav-link" href="/suratkeluar" id="suratkeluar">
        <i class="icon-envelope-open menu-icon"></i>
        <span class="menu-title">Surat Keluar</span>
      </a>
    </li>

    <!-- Proposal -->
    <li class="nav-item
      {{ request()->routeIs('proposal_dipa_penelitian.*') ? 'active' : '' }}
      {{ request()->routeIs('proposal_dipa_pengabdian.*') ? 'active' : '' }}
      {{ request()->routeIs('proposal_pusat_penelitian.*') ? 'active' : '' }}
      {{ request()->routeIs('proposal_pusat_pengabdian.*') ? 'active' : '' }}
      {{ request()->routeIs('proposal_mandiri_penelitian.*') ? 'active' : '' }}
      {{ request()->routeIs('proposal_mandiri_pengabdian.*') ? 'active' : '' }}
    ">
      <a class="nav-link" data-toggle="collapse" href="#proposal" role="button" aria-expanded="false" aria-controls="proposal">
        <i class="icon-book-open menu-icon"></i>
        <span class="menu-title">Proposal</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="proposal">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/proposal_dipa_penelitian">Proposal DIPA <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="/proposal_dipa_pengabdian">Proposal DIPA <br>Pengabdian</a></li>
          <li class="nav-item"><a class="nav-link" href="/proposal_pusat_penelitian">Proposal Pusat <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="/proposal_pusat_pengabdian">Proposal Pusat <br>Pengabdian</a></li>
          <li class="nav-item"><a class="nav-link" href="/proposal_mandiri_penelitian">Proposal Mandiri <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="/proposal_mandiri_pengabdian">Proposal Mandiri <br>Pengabdian</a></li>
        </ul>
      </div>
    </li>

    <!-- Laporan -->
    <li class="nav-item
      {{ request()->routeIs('laporan_kemajuan_penelitian.*') ? 'active' : '' }}
      {{ request()->routeIs('laporan_kemajuan_pengabdian.*') ? 'active' : '' }}
      {{ request()->routeIs('laporan_akhir_penelitian.*') ? 'active' : '' }}
      {{ request()->routeIs('laporan_akhir_pengabdian.*') ? 'active' : '' }}
      {{ request()->routeIs('anggaran_penelitian.*') ? 'active' : '' }}
      {{ request()->routeIs('anggaran_pengabdian.*') ? 'active' : '' }}
    ">
      <a class="nav-link" data-toggle="collapse" href="#laporan" role="button" aria-expanded="false" aria-controls="laporan">
        <i class="icon-notebook menu-icon"></i>
        <span class="menu-title">Laporan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="laporan">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/laporan_kemajuan_penelitian">Laporan Kemajuan <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="/laporan_kemajuan_pengabdian">Laporan Kemajuan <br>Pengabdian</a></li>
          <li class="nav-item"><a class="nav-link" href="/laporan_akhir_penelitian">Laporan Akhir <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="/laporan_akhir_pengabdian">Laporan Akhir <br>Pengabdian</a></li>
          <li class="nav-item"><a class="nav-link" href="/anggaran_penelitian">Laporan Keuangan <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="/anggaran_pengabdian">Laporan Keuangan <br>Pengabdian</a></li>
        </ul>
      </div>
    </li>

    <!-- Skema -->
    <li class="nav-item
      {{ request()->routeIs('skemaPenelitian.*') ? 'active' : '' }}
      {{ request()->routeIs('skemaPengabdian.*') ? 'active' : '' }}
    ">
      <a class="nav-link" data-toggle="collapse" href="#skema" role="button" aria-expanded="false" aria-controls="skema">
        <i class="icon-organization menu-icon"></i>
        <span class="menu-title">Skema</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="skema">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/skemaPenelitian" id="skemaPenelitian">Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="/skemaPengabdian" id="skemaPengabdian">Pengabdian</a></li>
        </ul>
      </div>
    </li>

    <!-- Jurusan -->
    <li class="nav-item {{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
      <a class="nav-link" href="/jurusan" id="jurusan">
        <i class="icon-graduation menu-icon"></i>
        <span class="menu-title">Jurusan</span>
      </a>
    </li>

    <!-- Prodi -->
    <li class="nav-item {{ request()->routeIs('prodi.*') ? 'active' : '' }}">
      <a class="nav-link" href="/prodi" id="prodi">
        <i class="icon-badge menu-icon"></i>
        <span class="menu-title">Prodi</span>
      </a>
    </li>

    <!-- Jenis Arsip -->
    <li class="nav-item {{ request()->routeIs('jenisarsip.*') ? 'active' : '' }}">
      <a class="nav-link" href="/jenisarsip" id="jenis">
        <i class="icon-tag menu-icon"></i>
        <span class="menu-title">Jenis Arsip</span>
      </a>
    </li>

  </ul>
</nav>
