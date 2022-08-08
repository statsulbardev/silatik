<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            @if (count($daftar_surat) > 0)
                <div class="card-header">
                    <h4>Daftar Surat {{ auth()->user()->relasiUnitFungsi->nama }}</h4>
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
                                @foreach ($daftar_surat->paginate(20) as $index => $item)
                                    <tr>
                                        {{-- Informasi Surat --}}
                                        <td>
                                            <label class="text-primary">
                                                <span style="letter-spacing: 1px">
                                                    No. {{ $item->no_surat }},
                                                    <i class="fa-solid fa-calendar"></i> {{ DateFormat::convertDateTime($item->tanggal_surat) }}
                                                </span>
                                            </label>
                                            <span><div>{!! $item->perihal !!}</div></span><br>

                                            @include('components.partials.orang-baca', [
                                                'route' => 'kf-detail-surat-masuk',
                                                'surat' => $item
                                            ])
                                        </td>

                                        {{-- Pengirim Surat --}}
                                        <td>{{ $item->pengirim }}</td>

                                        {{-- Tanggal Surat Diterima --}}
                                        <td>
                                            {{ DateFormat::convertDateTime($item->tanggal_buat) }}
                                        </td>

                                        {{-- Status --}}
                                        <td>
                                            <div class="badge badge-primary mb-1">
                                                <i class="fa-solid fa-check"></i>
                                                Disposisi Kepala
                                            </div><br>
                                            @if (str_contains($nama_routing, "disposisi"))
                                                <div class="badge badge-danger mb-1">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Disposisi KF
                                                </div><br>
                                            @else
                                                <div class="badge badge-primary mb-1">
                                                    <i class="fa-solid fa-check"></i>
                                                    Disposisi KF
                                                </div><br>
                                            @endif
                                            @include('components.partials.status-baca', ['item' => $item])
                                        </td>

                                        {{-- Aksi --}}
                                        <td>
                                            @if (str_contains($nama_routing, "disposisi"))
                                                <a href="{{ route('kf-disposisi-surat-masuk', $item->id) }}" id="disposisi" class="btn btn-icon btn-warning">
                                                    <i class="fas fa-tags"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('kf-detail-surat-masuk', $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
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
                <div class="card-footer text-right">
                    {{ $daftar_surat->paginate(20)->links('vendor.pagination.silatik') }}
                </div>
            @else
                @include('components.partials.not-found', ['pesan' => 'Maaf, belum ada surat yang didisposisikan kepada anda.'])
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    tippy('#disposisi', {
        content: 'Disposisi Surat',
        placement: 'bottom',
        arrow: true
    })
    tippy('#lihat', {
        content: 'Lihat Surat',
        placement: 'bottom',
        arrow: true
    })
</script>
@endpush
