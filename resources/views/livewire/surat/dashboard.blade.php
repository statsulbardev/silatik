@section('title', 'Dashboard')

<div>
    <section class="section">

        @hasanyrole('kabps|kabag|kf')
            @include('components.partials.header', [ 'judul' => 'Selamat Datang, ' . auth()->user()->nama ])
            @include('components.partials.dashboard-template.card-preview', [
                'sm_berjalan'  => $sm_berjalan,
                'sm_total'     => $sm_total,
                'sm_disposisi' => $sm_disposisi
            ])
        @else
            @include('components.partials.header', [ 'judul' => 'Dashboard'])
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
        @endhasanyrole
    </section>
</div>
