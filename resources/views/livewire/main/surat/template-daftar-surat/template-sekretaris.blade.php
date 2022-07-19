<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="mx-auto"></div>
                <a href="{{ env('APP_URL') . $routing . '/sekretaris/tambah' }}" class="btn btn-icon icon-left btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Entri {{ str_replace('-',' ',ucwords($routing, '-')) }}
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
                                <th>Status Disposisi</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($daftar_surat as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <i class="fas fa-calendar"></i>&nbsp;
                                        {{ DateFormat::convertDateTime($item->tanggal_buat) }}</td>
                                    <td>
                                        <label class="text-primary">
                                            <span style="letter-spacing: 1px">
                                                No. {{ $item->no_surat }},
                                                <i class="fas fa-calendar"></i> {{ DateFormat::convertDateTime($item->tanggal_surat) }}
                                            </span>
                                        </label><br>
                                        <span>{!! $item->perihal !!}</span>
                                    </td>
                                    <td>{{ $item->pengirim }}</td>
                                    <td>
                                        @if ($item->relasiDisposisi)
                                            <div class="badge badge-primary">Sudah Disposisi</div>
                                        @else
                                            <div class="badge badge-warning">Belum Disposisi</div>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($item->tipe)
                                            @case('sm')
                                                @if ($item->relasiDisposisi)
                                                    <a href="{{ env('APP_URL') . 'surat-masuk/sekretaris/' . $item->id }}" id="lihat" class="btn btn-icon btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ env('APP_URL') . 'surat-masuk/sekretaris/' . $item->id }}" id="lihat" class="btn btn-icon btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ env('APP_URL') . 'surat-masuk/sekretaris/edit/' . $item->id }}" id="edit" class="btn btn-icon btn-warning">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>
                                                    <button wire:click="delete({{ $item->id }})" id="hapus" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                                @break
                                            @case('sk')
                                                @break
                                        @endswitch
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
