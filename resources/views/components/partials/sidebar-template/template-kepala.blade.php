<li class="menu-header">SURAT MASUK</li>
<li>
    <a href="{{ url(env('APP_URL') . 'surat-masuk/kepala') }}" class="nav-link">
        <i class="fas fa-right-to-bracket"></i>
        <span>Daftar Surat</span>
    </a>
    @if (auth()->user()->unit_kerja_id == 1)
        <a href="{{ url(env('APP_URL') . 'surat-masuk/kepala/disposisi') }}" class="nav-link">
            <i class="fas fa-paper-plane"></i>
            <span>Disposisi</span>
        </a>
    @endif
</li>
<li class="menu-header">SURAT KELUAR</li>
<li>
    <a href="{{ url(env('APP_URL') . 'surat-keluar/kepala') }}">
        <i class="fas fa-right-from-bracket"></i>
        <span>Surat Keluar</span>
    </a>
    <a href="{{ url(env('APP_URL') . 'surat-keluar/kepala/periksa') }}" class="nav-link">
        <i class="fas fa-check-double"></i>
        <span>Pemeriksaan</span>
    </a>
</li>
