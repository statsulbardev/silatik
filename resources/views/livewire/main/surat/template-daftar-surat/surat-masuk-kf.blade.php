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
                                <th>Tanggal Surat</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($daftar_surat->paginate(20) as $index => $item)
                                <tr>
                                    {{-- No. Index --}}
                                    <td>{{ $index + 1 }}</td>

                                    {{-- Informasi Surat --}}
                                    <td>
                                        <label class="text-primary">
                                            <span style="letter-spacing: 1px">
                                                No. {{ $item->no_surat }}
                                            </span>
                                        </label>
                                        <span>{!! $item->perihal !!}</span>
                                    </td>

                                    {{-- Pengirim Surat --}}
                                    <td>{{ $item->pengirim }}</td>

                                    {{-- Tanggal Surat Diterima --}}
                                    <td>
                                        <i class="fas fa-calendar"></i>&nbsp;
                                        {{ DateFormat::convertDateTime($item->tanggal_surat) }}
                                    </td>

                                    {{-- Aksi --}}
                                    <td>
                                        <a href="{{ url(env('APP_URL') . 'surat-masuk/kf/' . $item->id) }}" id="lihat" class="btn btn-icon btn-primary">
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
                {{ $daftar_surat->paginate(20)->links('vendor.pagination.silatik') }}
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
