<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            @if (count($daftar_surat) > 0)
                <div class="card-header">
                    <div class="mx-auto"></div>
                    <a href="{{ url(env('APP_URL') . 'surat-keluar/staf/tambah') }}" class="btn btn-icon icon-left btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Entri
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-md">
                            <tbody>
                                <tr>
                                    <th>Informasi Surat</th>
                                    <th>Pengirim</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Status Disposisi</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($daftar_surat->paginate(20) as $index => $item)
                                    <tr>
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
                                            {{ DateFormat::convertDateTime($item->tanggal_buat) }}
                                        </td>
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
                                                    @break
                                                @case('sk')
                                                    @if ($item->relasiDisposisi)
                                                        <a href="{{ url(env('APP_URL') . 'surat-keluar/staf/' . $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ url(env('APP_URL') . 'surat-keluar/staf/' . $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ url(env('APP_URL') . 'surat-keluar/staf/edit/' . $item->id) }}" id="edit" class="btn btn-icon btn-warning">
                                                            <i class="fas fa-pencil"></i>
                                                        </a>
                                                        <button wire:click="delete({{ $item->id }})" id="hapus" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
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
                    {{ $daftar_surat->paginate(20)->links('vendor.pagination.silatik') }}
                </div>
            @else
                @include('components.partials.not-found', ['pesan' => 'Maaf, belum surat yang anda ajukan.'])
            @endif
        </div>
    </div>
</div>
