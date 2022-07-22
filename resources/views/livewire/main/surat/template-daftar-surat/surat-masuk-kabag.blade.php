<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
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
                                <th>No.</th>
                                <th>Informasi Surat</th>
                                <th>Pengirim</th>
                                <th>Tanggal Terima</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($daftar_surat as $index => $item)
                                <tr>
                                    {{-- No. Index --}}
                                    <td>{{ $index + 1 }}</td>

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

                                    {{-- Tanggal Surat Diterima --}}
                                    <td>
                                        <i class="fas fa-calendar"></i>&nbsp;
                                        {{ DateFormat::convertDateTime($item->tanggal_buat) }}
                                    </td>

                                    {{-- Aksi --}}
                                    <td>
                                        <a href="{{ url(env('APP_URL') . 'surat-masuk/kabag/' . $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
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
    tippy('#periksa', {
        content: 'Periksa Surat',
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
