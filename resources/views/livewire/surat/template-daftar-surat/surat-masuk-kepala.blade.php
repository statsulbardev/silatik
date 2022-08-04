<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            @if (count($daftar_surat) > 0)
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
                                <input type="text" class="form-control" placeholder="Cari Surat...">
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
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($daftar_surat->paginate(20) as $item)
                                    <tr>
                                        <td>
                                            <label class="text-primary">
                                                <span style="letter-spacing: 1px">
                                                    No. {{ $item->no_surat }},
                                                    <i class="fa-solid fa-calendar"></i> {{ DateFormat::convertDateTime($item->tanggal_surat) }}
                                                </span>
                                            </label>
                                            <span><div>{!! $item->perihal !!}</div></span><br>

                                            @if (!str_contains($nama_routing, "disposisi"))
                                                @include('components.partials.orang-baca', [
                                                    'route' => 'kepala-detail-surat-masuk',
                                                    'surat' => $item
                                                ])
                                            @endif
                                        </td>

                                        {{-- Pengirim Surat --}}
                                        <td>{{ $item->pengirim }}</td>

                                        {{-- Tanggal Surat Dibuat/Dientri --}}
                                        <td>
                                            {{ DateFormat::convertDateTime($item->tanggal_buat) }}
                                        </td>

                                        {{-- Status --}}
                                        <td>
                                            @if (str_contains($nama_routing, "disposisi"))
                                                <span class="badge badge-danger">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Belum Disposisi
                                                </span>
                                            @else
                                                <span class="badge badge-primary">
                                                    <i class="fa-solid fa-check"></i>
                                                    Sudah Disposisi
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Aksi --}}
                                        <td>
                                            @if (str_contains($nama_routing, "disposisi"))
                                                <a href="{{ route('kepala-disposisi-surat-masuk', $item->id) }}" id="disposisi" class="btn btn-icon btn-warning">
                                                    <i class="fa-solid fa-tags"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('kepala-detail-surat-masuk', $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="card-footer text-right">
                    {{ $daftar_surat->paginate(20)->links('vendor.pagination.silatik') }}
                </div>
            @else
                @include('components.partials.not-found', ['pesan' => 'Maaf, belum ada surat yang anda dapat disposisikan.'])
            @endif
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
