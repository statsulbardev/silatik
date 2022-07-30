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
                            Versi Fremework
                        </p>
                        <p class="h5 ml-2 mt-3 font-weight-bold" style="letter-spacing:1px">
                            Powered By Laravel {{ app()->version() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header ui-sortable-handle d-flex justify-content-between">
                        <h4>Versi Aplikasi : {{ $tag }}</h4>
                        <span class="font-weight-bold">Versi Commit : {{ $commit }}</span>
                    </div>
                    <div class="card-body">
                        <h4>Daftar Perbaikan dan Peningkatan :</h4>
                        <ol>
                            @foreach ($deskripsi as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
