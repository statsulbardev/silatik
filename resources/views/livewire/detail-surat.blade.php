@section('title', 'Surat No. ' . $surat->no_surat)

@section('styles')
<style>
    .card-columns { column-count: 2; !important }
</style>
@endsection

<div>
    <section class="section">
        @include('components.partials.header', ['judul' => 'Surat No. ' . $surat->no_surat])

        <div class="card-columns">
            {{-- Informasi Surat --}}
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Surat</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-md">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">Nomor Agenda</td>
                                    <td width="2%">:</td>
                                    <td>{{ $surat->no_agenda }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Nomor Surat</td>
                                    <td width="2%">:</td>
                                    <td>{{ $surat->no_surat }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Surat</td>
                                    <td width="2%">:</td>
                                    <td>{{ DateFormat::convertDateTime($surat->tanggal_surat) }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Pengirim</td>
                                    <td width="2%">:</td>
                                    <td>{{ $surat->pengirim }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Perihal Surat</td>
                                    <td width="2%">:</td>
                                    <td>{{ $surat->perihal }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tingkat Keamanan</td>
                                    <td width="2%">:</td>
                                    <td>
                                        {{
                                            [
                                                'SR' => 'Sangat Rahasia',
                                                'R'  => 'Rahasia',
                                                'B'  => 'Biasa'
                                            ][$surat->tk_keamanan]
                                        }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Terima Surat</td>
                                    <td width="2%">:</td>
                                    <td>{{ DateFormat::convertDateTime($surat->tanggal_buat) }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Dientri Oleh</td>
                                    <td width="2%">:</td>
                                    <td>{{ $surat->relasiPegawai->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Unit Fungsi</td>
                                    <td width="2%">:</td>
                                    <td>{{ $surat->relasiPegawai->relasiUnitFungsi->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Kode Paraf</td>
                                    <td width="2%">:</td>
                                    <td>{{ $surat->relasiDisposisi->kode_paraf }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top text-center">
                        <div style="width: 22%" class="my-4 mx-auto">
                            @include('components.icons.pdf-file')
                        </div>
                        <a href="{{ google_view_file($surat->relasiBerkas->max()->tautan) }}" target="_blank" class="btn btn-icon icon-left btn-primary">
                            <i class="fas fa-eye"></i> Lihat Berkas
                        </a>
                    </div>
                </div>
            </div>

            {{-- History Tindak Lanjut / Disposisi --}}
            <div class="card">
                <div class="card-header">
                    <h4>History Tindak Lanjut / Disposisi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Dari</th>
                                <th>Kepada</th>
                                <th>Ket</th>
                                <th>Disposisi</th>
                            </tr>
                            <tr>
                                <td>
                                    Kepala BPS Provinsi Sulawesi Barat
                                </td>
                                <td>
                                    @if (!is_null($surat->relasiDisposisi->unit_fungsi_penerima))
                                        <div class="my-3">
                                            <span class="font-weight-bold text-primary">{{ \App\Models\UnitKerja::find((int) $surat->relasiDisposisi->unit_kerja_penerima)->nama }}</span>
                                            <ul class="pl-3">
                                            @foreach ($surat->relasiDisposisi->unit_fungsi_penerima as $index => $item)
                                                <li>{{ \App\Models\UnitFungsi::find((int) $item)->nama }}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <span>{{ \App\Models\UnitKerja::find((int) $surat->relasiDisposisi->unit_kerja_penerima)->nama }}</span>
                                    @endif
                                </td>
                                <td>
                                    {!! $surat->relasiDisposisi->catatan !!}
                                </td>
                                <td>
                                    <ul class="pl-3">
                                        @foreach ($surat->relasiDisposisi->poin as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
