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
            <a class="nav-link" href="{{ route('suratmasuk.index') }}" id="suratmasuk">
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
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#proposal" role="button"
            aria-expanded="false" aria-controls="proposal">
            <i class="icon-book-open menu-icon"></i>
            <span class="menu-title">Proposal</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="proposal">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('proposal.index') }}">Proposal Pengabdian</a></li>
              <li class="nav-item"> <a class="nav-link" href=" ">Proposal Penelitian <br> DP</a></li>
              <li class="nav-item"> <a class="nav-link" href=" ">Proposal Penelitian <br> Unggulan</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#laporan" role="button"
            aria-expanded="false" aria-controls="laporan" >
            <i class="icon-notebook menu-icon"></i>
            <span class="menu-title">Laporan</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="laporan">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('laporan_kegiatan_pengabdian.index') }}" >Laporan Kegiatan <br> Pengabdian</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('laporan_pengabdian.index') }}" >Laporan Akhir <br> Pengabdian</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route ('laporan_penelitian.index') }}" >Laporan Akhir <br> Penelitian</a></li>
            </ul>
          </div>
        </li>
         <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#anggaran" role="button"
            aria-expanded="false" aria-controls="anggaran" >
            <i class="icon-chart menu-icon"></i>
            <span class="menu-title">Anggaran</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="anggaran">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('anggaran_penelitian.index') }}" >Anggaran <br>Penelitian</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('anggaran_pengabdian.index') }}" >Anggaran <br>Pengabdian</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="" id="jurusan">
              <i class="icon-people menu-icon"></i>
              <span class="menu-title">Pengabdian Kepada <br> Masyarakat</span>
            </a>
          </li>
         <li class="nav-item">
            <a class="nav-link " href="/jurusan" id="jurusan">
              <i class="icon-graduation menu-icon"></i>
              <span class="menu-title">Jurusan</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link " href="/prodi" id="prodi">
              <i class="icon-badge menu-icon"></i>
              <span class="menu-title">Prodi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('jenisarsip.index') }}" id="jenis">
              <i class="icon-tag menu-icon"></i>
              <span class="menu-title">Jenis Arsip</span>
            </a>
          </li>
           <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#skema" role="button"
            aria-expanded="false" aria-controls="skema" >
            <i class="icon-organization menu-icon"></i>
            <span class="menu-title">Skema</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="skema">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="/skemaPenelitian" >Penelitian</a></li>
              <li class="nav-item"> <a class="nav-link" href="/skemaPengabdian" >Pengabdian</a></li>
            </ul>
          </div>
        </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('log.index') }}" id="log">
                <i class="icon-doc menu-icon"></i>
               <span class="menu-title">Log Aktivitas</span>
              </a>
            </li>
        </ul>
      </nav>
