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
                <a wire:click="hasRead({{ auth()->user()->id }}, {{ $surat->id }})" href="{{ google_view_file($surat->relasiBerkas->sortDesc()->max()->tautan) }}" target="_blank" class="btn btn-icon icon-left btn-primary">
                    <i class="fas fa-eye"></i>
                    Lihat Berkas
                </a>
            </div>
        </div>
    </div>

    {{-- History Disposisi --}}
    <div class="card">
        <div class="card-header">
            <h4>History Tindak Lanjut / Disposisi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Dari</th>
                        <th>Kepada</th>
                        <th>Ket</th>
                        <th>Disposisi</th>
                        <th>Tanggal</th>
                    </tr>
                    <tr>
                        <td>
                            Kepala {{ \App\Models\UnitKerja::find($surat->unit_kerja_id)->pluck('nama')[0] }}
                        </td>
                        <td>
                            @if (count($surat->relasiDisposisi->unit_fungsi_koordinasi[0]['unit']) > 1)
                                <ul class="pl-3">
                                    @foreach ($surat->relasiDisposisi->unit_fungsi_koordinasi[0]['unit'] as $item)
                                        <li>{{ \App\Models\UnitFungsi::where('id', $item)->pluck('nama')[0] }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {{ \App\Models\UnitFungsi::where('id', $surat->relasiDisposisi->unit_fungsi_koordinasi[0]['unit'])->pluck('nama')[0] }}
                            @endif
                        </td>
                        <td>
                            {!! $surat->relasiDisposisi->unit_fungsi_koordinasi[0]['catatan'] !!}
                        </td>
                        <td>
                            @if (empty($surat->relasiDisposisi->poin))
                                -
                            @else
                                <ul class="pl-3">
                                    @foreach ($surat->relasiDisposisi->poin as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            {{ DateFormat::convertDateTime(date('Y-m-d', strtotime($surat->relasiDisposisi->unit_fungsi_koordinasi[0]['tgl_disposisi']))) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Tindak Lanjut/Disposisi --}}
    <div class="card">
        <form wire:submit.prevent="save">
            <div class="card-header">
                <h4>Tindak Lanjut / Disposisi Surat</h4>
            </div>
            <div class="card-body">
                {{-- Tujuan Penerima --}}
                <div class="row border-bottom mb-4">
                    <div class="col-12 col-md-2 col-lg-2">
                        <span class="font-weight-bold">Kepada</span>
                    </div>
                    <div class="col-12 col-md-10 col-lg-10">
                        {{-- Unit Fungsi --}}
                        @foreach ($unitFungsi as $item)
                            <div class="row mb-4">
                                <x-forms.checkbox judul='{{ $item->nama }}' model='penerima' nilai='{{ $item->id }}' style='col-12 col-md-10 col-lg-10' />
                            </div>
                        @endforeach

                        {{-- error message --}}
                        @include('components.notifications.error-field', [
                            'model' => 'penerima'
                            'pesan' => 'Tujuan disposisi dibutuhkan, pilih minimal satu tujuan disposisi.'
                        ])
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

                        {{-- error message --}}
                        @include('components.notifications.error-field', [
                            'model' => 'catatan',
                            'pesan' => 'Isian kolom catatan dibutuhkan, isikan minimal 5 karakter.'
                        ])
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
