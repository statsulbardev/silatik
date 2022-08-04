<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            @if (auth()->user()->relasiUnitFungsi->nama === 'Fungsi Umum')
                <div class="card-header">
                    <h4>Daftar Surat</h4>
                </div>
            @endif

            @if (count($daftar_surat) > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-md">
                            <tbody>
                                <tr>
                                    @umum
                                        <th>No. Agenda</th>
                                    @endumum
                                    <th>Informasi Surat</th>
                                    <th>Pengirim</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($daftar_surat->paginate(20) as $item)
                                    <tr>
                                        @umum
                                            <td>{{ $item->no_agenda }}</td>
                                        @endumum

                                        {{-- Informasi Surat --}}
                                        <td>
                                            <label class="text-primary">
                                                <span style="letter-spacing: 1px">
                                                    No. {{ $item->no_surat }},
                                                    <i class="fa-solid fa-calendar"></i> {{ DateFormat::convertDateTime($item->tanggal_surat) }}
                                                </span>
                                            </label>
                                            <span>
                                                <div>{!! $item->perihal !!}</div>
                                            </span><br>

                                            @include('components.partials.orang-baca', [
                                                'route' => 'skf-detail-surat-masuk',
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
                                            @umum
                                                @if ($item->relasiDisposisi)
                                                    <div class="badge badge-primary">
                                                        <i class="fa-solid fa-check"></i>
                                                        Disposisi Kepala
                                                    </div>
                                                @else
                                                    <div class="badge badge-danger">
                                                        <i class="fa-solid fa-xmark"></i>
                                                        Disposisi Kepala
                                                    </div>
                                                @endif
                                            @else
                                                <div class="badge badge-primary mb-1">
                                                    <i class="fa-solid fa-check"></i>
                                                    Disposisi Kepala
                                                </div><br>
                                                <div class="badge badge-primary">
                                                    <i class="fa-solid fa-check"></i>
                                                    Disposisi Kabag/KF
                                                </div>
                                            @endumum
                                        </td>

                                        {{-- Aksi --}}
                                        <td>
                                            @umum
                                                @if ($item->relasiDisposisi)
                                                    <a href="{{ route('skf-detail-surat-masuk', $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('skf-detail-surat-masuk', $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('skf-edit-surat-masuk', $item->id) }}" id="edit" class="btn btn-icon btn-warning">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>
                                                    <button wire:click="delete({{ $item->id }})" id="hapus" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <a href="{{ route('skf-detail-surat-masuk', $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endumum
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
     tippy('#lihat', {
        content: 'Lihat Surat',
        placement: 'bottom',
        arrow: true
    })
    tippy('#edit', {
        content: 'Edit Surat',
        placement: 'bottom',
        arrow: true
    })
    tippy('#hapus', {
        content: 'Hapus Surat',
        placement: 'bottom',
        arrow: true
    })
</script>
@endpush
