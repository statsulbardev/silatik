<div class="row">
    <div class="col-12 col-md-3 col-lg-3">
        {{-- Surat Masuk --}}
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary mt-3 ml-3">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <span class="font-weight-bold">Sudah Disposisi</span>
                </div>
                <div class="card-body">
                    <span class="h3 font-weight-bold">{{ $sm_sdh_disposisi }}</span> <small>surat</small>
                </div>
            </div>
            <div class="card-footer bg-secondary mt-4 py-2">
                <span class="font-weight-bold">Total Surat Masuk Sebanyak {{ $sm_total }} Surat</span>
            </div>
        </div>
    </div>

    {{-- Disposisi Surat Masuk --}}
    <div class="col-12 col-md-3 col-lg-3">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning mt-3 ml-3">
                <i class="fas fa-paper-plane"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <span class="font-weight-bold">Belum Disposisi</span>
                </div>
                <div class="card-body">
                    <span class="h3 font-weight-bold">{{ $sm_disposisi }}</span> <small>surat</small>
                </div>
            </div>
            <div class="card-footer bg-secondary mt-4 py-2">
                <span class="font-weight-bold">Total Surat Masuk Sebanyak {{ $sm_total }} Surat</span>
            </div>
        </div>
    </div>

    {{-- Surat keluar --}}
    <div class="col-12 col-md-3 col-lg-3">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success mt-3 ml-3">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <span class="font-weight-bold">Surat Keluar Bulan Ini</span>
                </div>
                <div class="card-body">
                    <span class="h3 font-weight-bold">0</span> <small>surat</small>
                </div>
            </div>
            <div class="card-footer bg-secondary mt-4 py-2">
                <span class="font-weight-bold">Total Surat Keluar 0 Surat</span>
            </div>
        </div>
    </div>

    {{-- Pemeriksaan Surat Keluar --}}
    <div class="col-12 col-md-3 col-lg-3">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger mt-3 ml-3">
                <i class="fas fa-check-double"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <span class="font-weight-bold">Pemeriksaan Surat Keluar Bulan Ini</span>
                </div>
                <div class="card-body">
                    <span class="h3 font-weight-bold">0</span> <small>surat</small>
                </div>
            </div>
            <div class="card-footer bg-secondary mt-4 py-2">
                <span class="font-weight-bold">Total Surat Keluar 0 Surat</span>
            </div>
        </div>
    </div>
</div>
