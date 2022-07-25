<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            {{-- Judul --}}
            <div class="card-header">
                <h4>
                    @if (str_contains($nama_routing, "disposisi"))
                        Daftar surat yang akan di disposisi
                    @else
                        @if (auth()->user()->unit_kerja_id > 1)
                            Daftar Surat
                        @else
                            Daftar surat yang telah di disposisi
                        @endif
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
                                @if (auth()->user()->unit_kerja_id == 1)
                                    <th>Status</th>
                                @endif
                                <th>Aksi</th>
                            </tr>
                            @if (str_contains($nama_routing, "disposisi"))
                                @foreach ($daftar_surat->paginate(20) as $item)
                                    @if (is_null($item->relasiDisposisi))
                                        <tr>
                                            {{-- Nomor Surat --}}
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
                                                {{ DateFormat::convertDateTime($item->tanggal_buat) }}
                                            </td>

                                            {{-- Status --}}
                                            <td>
                                                <span class="badge badge-warning">Belum Disposisi</span>
                                            </td>

                                            {{-- Aksi --}}
                                            <td>
                                                <a href="{{ url(env('APP_URL') . 'surat-masuk/kepala/'. $item->id . '/disposisi') }}" id="disposisi" class="btn btn-icon btn-warning">
                                                    <i class="fas fa-tags"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($daftar_surat->paginate(20) as $item)
                                    @if($item->relasiDisposisi)
                                        <tr>
                                            {{-- Nomor Surat --}}
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
                                                {{ DateFormat::convertDateTime($item->tanggal_buat) }}
                                            </td>

                                            {{-- Status --}}
                                            @if (auth()->user()->unit_kerja_id == 1)
                                            <td><span class="badge badge-primary">Sudah Disposisi</span></td>
                                            @endif

                                            {{-- Aksi --}}
                                            <td>
                                                <a href="{{ url(env('APP_URL') . 'surat-masuk/kepala/' . $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
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
                {{ $daftar_surat->paginate(20)->links('vendor.pagination.silatik') }}
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
    tippy('#disposisi', {
        content: 'Disposisi Surat',
        placement: 'bottom',
        arrow: true
    })
</script>
@endpush
