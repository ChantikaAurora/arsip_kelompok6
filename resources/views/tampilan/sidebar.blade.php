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