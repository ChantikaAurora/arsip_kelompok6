 <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="/home">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pengguna">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Manajer</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('suratmasuk.index') }}">
              <i class="icon-envelope-letter menu-icon"></i>
              <span class="menu-title">Surat Masuk</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/suratkeluar">
              <i class="icon-envelope-open menu-icon"></i>
              <span class="menu-title">Surat Keluar</span>
            </a>
          </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#dokumen" role="button"
            aria-expanded="false" aria-controls="dokumen">
            <i class="icon-chart menu-icon"></i>
            <span class="menu-title">Dokumen Lainnya</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="dokumen">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('proposal.index') }}">Proposal Penelitian</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route ('laporan_penelitian.index') }}">Laporan Penelitian</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('anggaran_penelitian.index') }}">Anggaran Penelitian</a></li>
               {{-- <li class="nav-item">
                <a class="nav-link" href="#">
                  <span class="menu-title">Proposal Penelitian</span>
                </a>
              </li>
              <li class="nav-item"> <a class="nav-link" href="#">Laporan Penelitian</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Anggaran Penelitian</a></li> --}}
            </ul>
          </div>
        </li>

          <li class="nav-item">
            <a class="nav-link " href="{{ route('jenisarsip.index') }}">
              <i class="icon-tag menu-icon"></i>
              <span class="menu-title">Jenis Arsip</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link " href="#">
              <i class="icon-doc menu-icon"></i>
              <span class="menu-title">Log Aktivitas</span>
            </a>
          </li> -->
              <li class="nav-item">
                <a class="nav-link" href="{{ route('log.index') }}">
                <i class="icon-doc menu-icon"></i>
               <span class="menu-title">Log Aktivitas</span>
              </a>
            </li>



        </ul>
      </nav>