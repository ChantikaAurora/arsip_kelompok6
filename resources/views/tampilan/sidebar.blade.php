<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- User Manajer -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('pengguna.index') }}">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">User Manajer</span>
      </a>
    </li>

    <!-- Surat Masuk -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('suratmasuk.index') }}">
        <i class="icon-envelope-letter menu-icon"></i>
        <span class="menu-title">Surat Masuk</span>
      </a>
    </li>

    <!-- Surat Keluar -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('suratkeluar.index') }}">
        <i class="icon-envelope-open menu-icon"></i>
        <span class="menu-title">Surat Keluar</span>
      </a>
    </li>

    <!-- Proposal -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#proposal" role="button"
         aria-expanded="false" aria-controls="proposal">
        <i class="icon-book-open menu-icon"></i>
        <span class="menu-title">Proposal</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="proposal">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('proposal_pengabdian.index') }}">Proposal Pengabdian</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('proposal.index') }}">Proposal Penelitian <br> DP</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('proposal_unggulan.index') }}">Proposal Penelitian <br> Unggulan</a></li>
        </ul>
      </div>
    </li>

    <!-- Laporan -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#laporan" role="button"
         aria-expanded="false" aria-controls="laporan">
        <i class="icon-notebook menu-icon"></i>
        <span class="menu-title">Laporan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="laporan">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="#">Laporan Kegiatan <br> Pengabdian</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Laporan Akhir <br> Pengabdian</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('laporan_penelitian.index') }}">Laporan Akhir <br> Penelitian</a></li>
        </ul>
      </div>
    </li>

    <!-- Anggaran -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#anggaran" role="button"
         aria-expanded="false" aria-controls="anggaran">
        <i class="icon-chart menu-icon"></i>
        <span class="menu-title">Anggaran</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="anggaran">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('anggaran_penelitian.index') }}">Anggaran Penelitian</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Anggaran Pengabdian</a></li>
        </ul>
      </div>
    </li>

    <!-- Jurusan -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-graduation menu-icon"></i>
        <span class="menu-title">Jurusan</span>
      </a>
    </li>

    <!-- Prodi -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-badge menu-icon"></i>
        <span class="menu-title">Prodi</span>
      </a>
    </li>

    <!-- Jenis Arsip -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('jenisarsip.index') }}">
        <i class="icon-tag menu-icon"></i>
        <span class="menu-title">Jenis Arsip</span>
      </a>
    </li>

    <!-- Skema -->
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="icon-organization menu-icon"></i>
        <span class="menu-title">Skema</span>
      </a>
    </li>

    <!-- Log Aktivitas -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('log.index') }}">
        <i class="icon-doc menu-icon"></i>
        <span class="menu-title">Log Aktivitas</span>
      </a>
    </li>

  </ul>
</nav>
