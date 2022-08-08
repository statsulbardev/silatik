<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Surat</h4>
            </div>
            @if (count($daftar_surat) > 0)
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-md">
                            <tbody>
                                <tr>
                                    <th>No. Agenda</th>
                                    <th>Informasi Surat</th>
                                    <th>Pengirim</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($daftar_surat->paginate(20) as $item)
                                    <tr>
                                        {{-- Nomor Agenda Surat --}}
                                        <td>
                                            {{ $item->no_agenda }}
                                        </td>

                                        {{-- Informasi Surat --}}
                                        <td>
                                            <label class="text-primary">
                                                <span style="letter-spacing: 1px">
                                                    No. {{ $item->no_surat }},
                                                    <i class="fa-solid fa-calendar"></i> {{ DateFormat::convertDateTime($item->tanggal_surat) }}
                                                </span>
                                            </label><br>
                                            <span>
                                                <div>{!! $item->perihal !!}</div>
                                            </span><br>

                                            @include('components.partials.orang-baca', [
                                                'route' => 'sekretaris-detail-surat-masuk',
                                                'surat' => $item
                                            ])
                                        </td>

                                        {{-- Pengirim Surat --}}
                                        <td>{{ $item->pengirim }}</td>

                                        {{-- Tanggal Diterima --}}
                                        <td>
                                            {{ DateFormat::convertDateTime($item->tanggal_buat) }}
                                        </td>

                                        {{-- Status --}}
                                        <td>
                                            @if ($item->relasiDisposisi)
                                                <div class="badge badge-primary">
                                                    <i class="fa-solid fa-check"></i>
                                                    Sudah Disposisi
                                                </div><br>
                                            @else
                                                <div class="badge badge-danger mb-1">
                                                    <i class="fa-solid fa-xmark"></i>
                                                    Belum Disposisi
                                                </div><br>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->relasiDisposisi)
                                                <a href="{{ route('sekretaris-detail-surat-masuk', $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('sekretaris-detail-surat-masuk', $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('sekretaris-edit-surat-masuk', $item->id) }}" id="edit" class="btn btn-icon btn-warning">
                                                    <i class="fas fa-pencil"></i>
                                                </a>
                                                <button wire:click="delete({{ $item->id }})" id="hapus" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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
                @include('components.partials.not-found', ['pesan' => 'Maaf, belum ada surat masuk yang dientri.'])
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
