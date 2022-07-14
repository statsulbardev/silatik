@section('title', 'Daftar ' . str_replace('-',' ',ucwords(Route::currentRouteName(), '-')))

<div>
    <section class="section">
        @include('components.notifications.flash')

        @include('components.partials.header', [ 'judul' =>  str_replace('-',' ',ucwords(Route::currentRouteName(), '-')) ])

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header text-right">
                        <div class="mx-auto"></div>
                        <a href="{{ env('APP_URL') . Route::currentRouteName() . '/tambah' }}" class="btn btn-icon icon-left btn-primary">
                            <i class="fa-solid fa-plus"></i>
                            Entri {{ str_replace('-',' ',ucwords(Route::currentRouteName(), '-')) }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-md">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Nomor Agenda</th>
                                        <th>Tanggal Entri</th>
                                        <th>Tanggal Surat</th>
                                        <th>Nomor Surat</th>
                                        <th>Pengirim</th>
                                        <th>Perihal</th>
                                        <th>Tautan</th>
                                    </tr>
                                    @foreach ($data as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->no_agenda }}</td>
                                            <td>{{ DateFormat::convertDateTime($item->tanggal_buat) }}</td>
                                            <td>{{ DateFormat::convertDateTime($item->tanggal_surat) }}</td>
                                            <td>{{ $item->no_surat }}</td>
                                            <td>{{ $item->pengirim_surat }}</td>
                                            <td>{!! $item->perihal_surat !!}</td>
                                            <td>
                                                <a href="{{ google_view_file($item->tautan_surat) }}" class="btn btn-icon icon-left btn-success">
                                                    <i class="fa-solid fa-download"></i> Unduh
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
