<nav class="sidebar sidebar-offcanvas" id="sidebar">
  @php
      use Illuminate\Support\Str;
  @endphp

  <ul class="nav">
    {{-- Dashboard --}}
    <li class="nav-item">
      <a class="nav-link {{ Request::is('home') ? 'active-sub' : '' }}" href="/home">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    {{-- User Manajer --}}
    @php $isPengguna = Request::is('pengguna') || Request::is('pengguna/*'); @endphp
    <li class="nav-item">
      <a class="nav-link {{ $isPengguna ? 'active-sub' : '' }}" href="{{ route('pengguna.index') }}">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">User Manajer</span>
      </a>
    </li>

    {{-- Surat Masuk --}}
    @php $isSuratMasuk = Request::is('suratmasuk') || Request::is('suratmasuk/*'); @endphp
    <li class="nav-item">
      <a class="nav-link {{ $isSuratMasuk ? 'active-sub' : '' }}" href="{{ route('suratmasuk.index') }}">
        <i class="icon-envelope-letter menu-icon"></i>
        <span class="menu-title">Surat Masuk</span>
      </a>
    </li>

    {{-- Surat Keluar --}}
    @php $isSuratKeluar = Request::is('suratkeluar') || Request::is('suratkeluar/*'); @endphp
    <li class="nav-item">
      <a class="nav-link {{ $isSuratKeluar ? 'active-sub' : '' }}" href="{{ route('suratkeluar.index') }}">
        <i class="icon-envelope-open menu-icon"></i>
        <span class="menu-title">Surat Keluar</span>
      </a>
    </li>

    {{-- Dokumen Lainnya --}}
    @php
        $isProposal = Request::is('proposal') || Request::is('proposal/*');
        $isLaporan = Request::is('laporan_penelitian') || Request::is('laporan_penelitian/*');
        $isAnggaran = Request::is('anggaran_penelitian') || Request::is('anggaran_penelitian/*');
        $dokumenAktif = $isProposal || $isLaporan || $isAnggaran;
    @endphp

    <li class="nav-item">
      <a class="nav-link {{ $dokumenAktif ? '' : 'collapsed' }}" data-toggle="collapse" href="#dokumen"
         aria-expanded="{{ $dokumenAktif ? 'true' : 'false' }}" aria-controls="dokumen">
        <i class="icon-chart menu-icon"></i>
        <span class="menu-title">Dokumen Lainnya</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ $dokumenAktif ? 'show' : '' }}" id="dokumen">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link {{ $isProposal ? 'active-sub' : '' }}" href="{{ route('proposal.index') }}">
              Proposal Penelitian
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $isLaporan ? 'active-sub' : '' }}" href="{{ route('laporan_penelitian.index') }}">
              Laporan Penelitian
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $isAnggaran ? 'active-sub' : '' }}" href="{{ route('anggaran_penelitian.index') }}">
              Anggaran Penelitian
            </a>
          </li>
        </ul>
      </div>
    </li>

    {{-- Jenis Arsip --}}
    @php $isJenisArsip = Request::is('jenisarsip') || Request::is('jenisarsip/*'); @endphp
    <li class="nav-item">
      <a class="nav-link {{ $isJenisArsip ? 'active-sub' : '' }}" href="{{ route('jenisarsip.index') }}">
        <i class="icon-tag menu-icon"></i>
        <span class="menu-title">Jenis Arsip</span>
      </a>
    </li>

    {{-- Log Aktivitas --}}
    @php $isLog = Request::is('log') || Request::is('log/*') || Request::is('logaktivitas'); @endphp
    <li class="nav-item">
      <a class="nav-link {{ $isLog ? 'active-sub' : '' }}" href="{{ route('log.index') }}">
        <i class="icon-doc menu-icon"></i>
        <span class="menu-title">Log Aktivitas</span>
      </a>
    </li>
  </ul>
</nav>
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
              <li class="nav-item"> <a class="nav-link" href="" >Laporan Kegiatan <br> Pengabdian</a></li>
              <li class="nav-item"> <a class="nav-link" href="" >Laporan Akhir <br> Pengabdian</a></li>
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
              <li class="nav-item"> <a class="nav-link" href="{{ route('anggaran_penelitian.index') }}" >Anggaran Penelitian</a></li>
              <li class="nav-item"> <a class="nav-link" href="" >Anggaran Pengabdian</a></li>
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
            <a class="nav-link " href="" id="jurusan">
              <i class="icon-graduation menu-icon"></i>
              <span class="menu-title">Jurusan</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link " href="" id="jurusan">
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

