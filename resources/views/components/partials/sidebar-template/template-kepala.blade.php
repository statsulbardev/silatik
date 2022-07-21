<li class="menu-header">SURAT MASUK</li>
<li>
    <a href="{{ url(env('APP_URL') . 'surat-masuk/kepala') }}" class="nav-link">
        <i class="fas fa-mail-bulk"></i>
        <span>Daftar Surat</span>
    </a>
    <a href="{{ url(env('APP_URL') . 'surat-masuk/kepala/disposisi') }}" class="nav-link">
        <i class="fas fa-paper-plane"></i>
        <span>Disposisi</span>
    </a>
</li>
<li class="menu-header">SURAT KELUAR</li>
<li>
    <a href="{{ url(env('APP_URL') . 'surat-keluar/kepala') }}">
        <i class="fas fa-inbox"></i>
        <span>Surat Keluar</span>
    </a>
</li>
