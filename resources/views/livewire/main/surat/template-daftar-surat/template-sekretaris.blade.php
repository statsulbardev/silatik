<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
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
                                <th>No.</th>
                                <th>Tanggal Terima</th>
                                <th>Informasi Surat</th>
                                <th>Pengirim</th>
                                <th>Status Pemeriksaan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($daftar_surat as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <i class="fas fa-calendar"></i>&nbsp;
                                        {{ DateFormat::convertDateTime($item->tanggal_buat) }}</td>
                                    <td>
                                        <small class="font-weight-bold text-primary">
                                            <span style="letter-spacing: 1px">
                                                No. {{ $item->no_surat }},
                                                <i class="fas fa-calendar"></i> {{ DateFormat::convertDateTime($item->tanggal_surat) }}
                                            </span>
                                        </small><br>
                                        <span>{!! $item->perihal !!}</span><br><br>
                                        <a href="{{ google_view_file($item->relasiPemeriksaan->max()->relasiBerkas->tautan) }}" class="btn btn-icon icon-left btn-success" target="_blank">
                                            <i class="fas fa-eye"></i> Lihat Surat
                                        </a>
                                    </td>
                                    <td>{{ $item->pengirim }}</td>
                                    <td>
                                        @if ($item->relasiPemeriksaan->max()->cek_kepala === 'op')
                                            <div class="badge badge-primary">Selesai Diperiksa</div>
                                        @else
                                            <div class="badge badge-danger">Belum Selesai Diperiksa</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->tipe === 'sm' && $item->relasiPemeriksaan->max()->cek_kepala === 'op')
                                            @if ($item->relasiDisposisi)
                                                <div class="badge badge-success">Sudah Disposisi</div>
                                            @else
                                                <a href="{{ env('APP_URL') . Route::currentRouteName() . '/'. $item->id . '/disposisi' }}"
                                                    id="disposisi" class="btn btn-primary">
                                                    <i class="fas fa-tags"></i>
                                                </a>
                                            @endif
                                        @endif
                                        <button wire:click="delete({{ $item->id }})" id="hapus" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
