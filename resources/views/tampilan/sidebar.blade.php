<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/home" id="home">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/pengguna" id="pengguna">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">User Manajer</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link active" href="{{ route('suratmasuk.index') }}" id="suratmasuk">
        <i class="icon-envelope-letter menu-icon"></i>
        <span class="menu-title">Surat Masuk</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/suratkeluar" id="suratkeluar">
        <i class="icon-envelope-open menu-icon"></i>
        <span class="menu-title">Surat Keluar</span>
      </a>
    </li>

    <!-- Proposal -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#proposal" role="button" aria-expanded="false" aria-controls="proposal">
        <i class="icon-book-open menu-icon"></i>
        <span class="menu-title">Proposal</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="proposal">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('proposal_dipa_penelitian.index') }}">Proposal DIPA <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('proposal_dipa_pengabdian.index') }}">Proposal DIPA <br>Pengabdian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('proposal_pusat_penelitian.index') }}">Proposal Pusat <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('proposal_pusat_pengabdian.index') }}">Proposal Pusat <br>Pengabdian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('proposal_mandiri_penelitian.index') }}">Proposal Mandiri <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('proposal_mandiri_pengabdian.index') }}">Proposal Mandiri <br>Pengabdian</a></li>
        </ul>
      </div>
    </li>

    <!-- Laporan -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#laporan" role="button" aria-expanded="false" aria-controls="laporan">
        <i class="icon-notebook menu-icon"></i>
        <span class="menu-title">Laporan</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="laporan">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('laporan_kemajuan_penelitian.index') }}">Laporan Kemajuan <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('laporan_kemajuan_pengabdian.index') }}">Laporan Kemajuan <br>Pengabdian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('laporan_akhir_penelitian.index') }}">Laporan Akhir <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('laporan_akhir_pengabdian.index') }}">Laporan Akhir <br>Pengabdian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('anggaran_penelitian.index') }}">Laporan Keuangan <br>Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('anggaran_pengabdian.index') }}">Laporan Keuangan <br>Pengabdian</a></li>
        </ul>
      </div>
    </li>

    <!-- Skema -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#skema" role="button" aria-expanded="false" aria-controls="skema">
        <i class="icon-organization menu-icon"></i>
        <span class="menu-title">Skema</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="skema">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/skemaPenelitian">Penelitian</a></li>
          <li class="nav-item"><a class="nav-link" href="/skemaPengabdian">Pengabdian</a></li>
        </ul>
      </div>
    </li>

    <!-- Jurusan -->
    <li class="nav-item">
      <a class="nav-link" href="/jurusan" id="jurusan">
        <i class="icon-graduation menu-icon"></i>
        <span class="menu-title">Jurusan</span>
      </a>
    </li>

    <!-- Prodi -->
    <li class="nav-item">
      <a class="nav-link" href="/prodi" id="prodi">
        <i class="icon-badge menu-icon"></i>
        <span class="menu-title">Prodi</span>
      </a>
    </li>

    <!-- Jenis Arsip -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('jenisarsip.index') }}" id="jenis">
        <i class="icon-tag menu-icon"></i>
        <span class="menu-title">Jenis Arsip</span>
      </a>
    </li>
  </ul>
</nav>
