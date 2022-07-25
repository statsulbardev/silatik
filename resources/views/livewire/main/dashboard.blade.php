@section('title', 'Dashboard')

<div>
    <section class="section">
        @include('components.partials.header', [ 'judul' => 'Dashboard' ])

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-cloud-sun"></i>
                        </div>
                        <p class="h4 ml-2 mt-2" style="letter-spacing:1px;opacity:70%">
                            {{ \Carbon\Carbon::now()->locale('id')->dayName }}, {{ DateFormat::convertDateTime(\Carbon\Carbon::now()) }}
                        </p>
                        <p class="h5 ml-2 mt-3 font-weight-bold" style="letter-spacing: 1px">Selamat Datang, {{ auth()->user()->nama }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-gears"></i>
                        </div>
                        <p class="h4 ml-2 mt-2" style="letter-spacing:1px;opacity:70%">
                            Versi Aplikasi
                        </p>
                        <p class="h5 ml-2 mt-3 font-weight-bold" style="letter-spacing:1px">
                            1.0 Beta - Powered By Laravel {{ app()->version() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-statistic-2 card-primary">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Surat Masuk</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-statistic-2 card-warning">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Belum Disposisi</h4>
                        </div>
                        <div class="card-body">10</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-statistic-2 card-success">
                    <div class="card-icon bg-success">
                        <i class="far fa-user"></i>
                      </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-danger">4</div>
            </div>
        </div> --}}
    </section>
</div>
