@section('title', 'Pemeriksaan ' . $judul)

@section('styles')
<style>
    .card-columns { column-count: 2; !important }
</style>
@endsection

<div>
    <section class="section">
        @include('components.partials.header', [ 'judul' =>  'Pemeriksaan ' . $judul . ' No. ' . $surat->no_surat])

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
                                    <td>{!! $surat->perihal !!}</td>
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

            {{-- Tujuan Pengiriman Surat --}}
            <div class="card">
                <div class="card-header">
                    <h4>Tujuan Pengiriman Surat</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Dari</th>
                                <th>Kepada Unit Kerja</th>
                                <th>Kepada Unit Fungsi</th>
                            </tr>
                            <tr>
                                <td>{{ $surat->pengirim }}</td>
                                <td>
                                    <ul class="pl-3">
                                        @foreach ($surat->relasiPemeriksaan->sortDesc()->max()->unit_kerja_id as $item)
                                            <li>{{ \App\Models\UnitKerja::where('id', $item)->pluck('nama')[0] }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if (is_null($surat->relasiPemeriksaan->sortDesc()->max()->unit_fungsi_id))
                                        -
                                    @else
                                        <ul class="pl-3">
                                            @foreach ($surat->relasiPemeriksaan->sortDesc()->max()->unit_fungsi_id as $item)
                                                <li>{{ \App\Models\UnitFungsi::where('id', $item)->pluck('nama')[0] }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- History Pemeriksaan --}}
            @if ($role === 'kepala')
                <div class="card">
                    <div class="card-header">
                        <h4>Riwayat Pemeriksaan Surat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-md">
                                <tbody>
                                    <tr>
                                        <th>Status</th>
                                        <th>Pemeriksa</th>
                                        <th>Tanggal</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="badge badge-primary">Diterima</span>
                                        </td>
                                        <td>
                                            @php
                                                $unit_fungsi_pembuat = $surat->unit_fungsi_id;

                                                $unit_parent = \App\Models\UnitFungsi::where('id', $unit_fungsi_pembuat)->pluck('parent')->toArray();

                                                $nama_pegawai = \App\Models\Pegawai::where('unit_fungsi_id', $unit_parent[0])->pluck('nama');

                                            @endphp

                                            {{ $nama_pegawai[0] }}
                                        </td>
                                        <td>
                                            {{
                                                DateFormat::convertDateTime($surat->relasiPemeriksaan->sortDesc()->max()->tgl_cek_kf)
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Tindak Lanjut Pemeriksaan --}}
            <div class="card">
                <form wire:submit.prevent="save">
                    <div class="card-header">
                        <h4>Tindak Lanjut Pemeriksaan</h4>
                    </div>
                    <div class="card-body">
                        {{-- Poin-poin --}}
                        <div class="row border-bottom mb-4">
                            <div class="col-12 col-md-2 col-lg-2">
                                <span class="font-weight-bold">Poin</span>
                            </div>
                            <div class="col-12 col-md-10 col-lg-10">
                                <div class="row mb-4">
                                    <div class="ml-3 custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="diterima" name="poinRadio" class="custom-control-input" wire:model.defer="poin" value="op">
                                        <label class="custom-control-label" for="diterima">Diterima</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ditolak" name="poinRadio" class="custom-control-input" wire:model.defer="poin" value="tp">
                                        <label class="custom-control-label" for="ditolak">Ditolak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Keterangan --}}
                        <div class="row">
                            <div class="col-12 col-md-2 col-lg-2">
                                <span class="font-weight-bold">Keterangan</span>
                            </div>
                            <div class="col-12 col-md-10 col-lg-10">
                                <div class="form-group">
                                    <textarea wire:model.defer="catatan" class="form-control" style="height: 125px"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-secondary text-right">
                        <button type="submit" class="btn btn-icon icon-left btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
