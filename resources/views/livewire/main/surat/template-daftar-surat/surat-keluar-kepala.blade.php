<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            {{-- Judul --}}
            <div class="card-header">
                <h4>
                    @if (str_contains($nama_routing, "periksa"))
                        Daftar surat keluar yang akan diperiksa
                    @else
                        Daftar surat keluar yang telah diperiksa
                    @endif
                </h4>
                <div class="card-header-form">
                    <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            {{-- Konten --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-md">
                        <tbody>
                            <tr>
                                <th>Informasi Surat</th>
                                <th>Pengirim</th>
                                <th>Tanggal Diterima</th>
                                <th>Status Pemeriksaan</th>
                                <th>Aksi</th>
                            </tr>
                            @if (str_contains($nama_routing, "periksa"))
                                @foreach ($daftar_surat as $item )
                                    @if ($item->cek_kepala == 'bp' && $item->cek_kf == 'op')
                                        <tr>
                                            {{-- Informasi Surat --}}
                                            <td>
                                                <label class="text-primary">
                                                    <span style="letter-spacing: 1px">
                                                        No. {{ $item->no_surat }},
                                                        <i class="fas fa-calendar"></i> {{ DateFormat::convertDateTime($item->tanggal_surat) }}
                                                    </span>
                                                </label>
                                                <span>{!! $item->perihal !!}</span>
                                            </td>

                                            {{-- Pengirim Surat --}}
                                            <td>{{ $item->pengirim }}</td>

                                            {{-- Tanggal Surat Dibuat/Dientri --}}
                                            <td>
                                                <i class="fas fa-calendar"></i>&nbsp;
                                                {{ DateFormat::convertDateTime($item->tanggal_buat) }}
                                            </td>

                                            {{-- Status --}}
                                            <td>
                                                <span class="badge badge-warning">Belum Diperiksa</span>
                                            </td>

                                            {{-- Aksi --}}
                                            <td>
                                                <a href="{{ url(env('APP_URL') . 'surat-keluar/kepala/'. $item->id . '/periksa') }}" id="periksa" class="btn btn-icon btn-warning">
                                                    <i class="fas fa-tags"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($daftar_surat as $item)
                                    @if($item->cek_kepala == 'op')
                                        <tr>
                                            {{-- Informasi Surat --}}
                                            <td>
                                                <label class="text-primary">
                                                    <span style="letter-spacing: 1px">
                                                        No. {{ $item->no_surat }},
                                                        <i class="fas fa-calendar"></i> {{ DateFormat::convertDateTime($item->tanggal_surat) }}
                                                    </span>
                                                </label>
                                                <span>{!! $item->perihal !!}</span>
                                            </td>

                                            {{-- Pengirim Surat --}}
                                            <td>{{ $item->pengirim }}</td>

                                            {{-- Tanggal Surat Dibuat/Dientri --}}
                                            <td>
                                                <i class="fas fa-calendar"></i>&nbsp;
                                                {{ DateFormat::convertDateTime($item->tanggal_buat) }}
                                            </td>

                                            {{-- Status --}}
                                            <td>
                                                <span class="badge {{ $item->cek_kepala == 'op' ? 'badge-primary' : 'badge-danger' }}">{{ $item->cek_kepala == 'op' ? 'Diterima' : 'Ditolak' }}</span>
                                            </td>

                                            {{-- Aksi --}}
                                            <td>
                                                <a href="{{ url(env('APP_URL') . 'surat-keluar/kepala/' . $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
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

@push('scripts')
<script>
    tippy('#lihat', {
        content: 'Lihat Surat',
        placement: 'bottom',
        arrow: true
    })
    tippy('#periksa', {
        content: 'periksa Surat',
        placement: 'bottom',
        arrow: true
    })
</script>
@endpush
