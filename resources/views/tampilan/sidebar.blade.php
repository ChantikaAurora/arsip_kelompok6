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
          <a class="nav-link" data-toggle="collapse" href="#penelitian" role="button"
            aria-expanded="false" aria-controls="penelitian">
            <i class="icon-book-open menu-icon"></i>
            <span class="menu-title">Penelitian</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="penelitian">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('proposal.index') }}">Proposal Penelitian</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route ('laporan_penelitian.index') }}">Laporan Penelitian</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('anggaran_penelitian.index') }}">Anggaran Penelitian</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#pengabdian" role="button"
            aria-expanded="false" aria-controls="pengabdian" >
            <i class="icon-chart menu-icon"></i>
            <span class="menu-title">Pengabdian</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="pengabdian">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="" id="proposalpengabdian">Proposal Pengabdian</a></li>
              <li class="nav-item"> <a class="nav-link" href="" id="laporanpengabdian">Laporan Pengabdian</a></li>
              <li class="nav-item"> <a class="nav-link" href="" id="anggaranpengabdian">Anggaran Pengabdian</a></li>
            </ul>
          </div>
        </li>
         <li class="nav-item">
            <a class="nav-link " href="" id="jurusan">
              <i class="icon-graduation menu-icon"></i>
              <span class="menu-title">Jurusan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('jenisarsip.index') }}" id="jenis">
              <i class="icon-tag menu-icon"></i>
              <span class="menu-title">Jenis Arsip</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="" id="skema">
              <i class="icon-organization menu-icon"></i>
              <span class="menu-title">Skema</span>
            </a>
          </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('log.index') }}" id="log">
                <i class="icon-doc menu-icon"></i>
               <span class="menu-title">Log Aktivitas</span>
              </a>
            </li>
        </ul>
      </nav>
