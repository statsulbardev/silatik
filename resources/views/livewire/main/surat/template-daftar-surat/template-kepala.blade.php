<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Surat yang Akan Disposisi</h4>
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
                                <th>No.</th>
                                <th>Tanggal Terima</th>
                                <th>Informasi Surat</th>
                                <th>Pengirim</th>
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
                                        </label>
                                        <span>{!! $item->perihal !!}</span><br>
                                        @if ($item->relasiDisposisi)
                                            <div class="badge badge-primary">Sudah Disposisi</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->pengirim }}</td>
                                    <td>
                                        @if ($item->tipe === 'sm')
                                            @if ($item->relasiDisposisi)
                                                <a href="{{ env('APP_URL') . 'surat-masuk/kepala/' . $item->id }}" id="lihat" class="btn btn-icon btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @else
                                                <a href="{{ env('APP_URL') . $routing . '/kepala/'. $item->id . '/disposisi' }}"
                                                    id="disposisi" class="btn btn-success">
                                                    <i class="fas fa-tags"></i>
                                                </a>
                                            @endif
                                        @endif
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
    tippy('#disposisi', {
        content: 'Disposisi Surat',
        placement: 'bottom',
        arrow: true
    })
</script>
@endpush
