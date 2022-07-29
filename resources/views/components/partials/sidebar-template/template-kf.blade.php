<li class="menu-header">SURAT MASUK</li>
<li>
    <a href="{{ url(env('APP_URL') . 'surat-masuk/kf') }}" class="nav-link">
        <i class="fas fa-right-to-bracket"></i>
        <span>Daftar Surat</span>
    </a>
    <a href="{{ url(env('APP_URL') . 'surat-masuk/kf/disposisi') }}" class="nav-link">
        <i class="fas fa-paper-plane"></i>
        <span>Disposisi</span>
    </a>
</li>
<li class="menu-header">SURAT KELUAR</li>
<li>
    <a href="{{ url(env('APP_URL') . 'surat-keluar/kf') }}" class="nav-link">
        <i class="fas fa-right-from-bracket"></i>
        <span>Daftar Surat</span>
    </a>
    <a href="{{ url(env('APP_URL') . 'surat-keluar/kf/periksa') }}" class="nav-link">
        <i class="fas fa-check-double"></i>
        <span>Pemeriksaan</span>
    </a>
</li>
