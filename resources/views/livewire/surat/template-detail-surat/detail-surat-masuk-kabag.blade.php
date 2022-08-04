{{-- History Tindak Lanjut / Disposisi --}}
<div class="card">
    <div class="card-header">
        <h4>History Tindak Lanjut / Disposisi</h4>
    </div>
    @if ($surat->relasiDisposisi)
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Dari</th>
                        <th>Kepada</th>
                        <th>Keterangan</th>
                        <th>Disposisi</th>
                        <th>Tanggal</th>
                    </tr>

                    {{-- Baris Disposisi Kepala kepada Kabag/KF --}}
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
                                {{ \App\Models\UnitFungsi::where('id', auth()->user()->unit_fungsi_id)->pluck('nama')[0] }}
                            @endif
                        </td>
                        <td>
                            {!! $surat->relasiDisposisi->unit_fungsi_koordinasi[0]['catatan'] !!}
                        </td>
                        <td>
                            @if (count($surat->relasiDisposisi->poin) > 1)
                                <ul class="pl-3">
                                    @foreach ($surat->relasiDisposisi->poin as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {{ $surat->relasiDisposisi->poin[0] }}
                            @endif
                        </td>
                        <td>
                            {{ DateFormat::convertDateTime(date('Y-m-d', strtotime($surat->relasiDisposisi->unit_fungsi_koordinasi[0]['tgl_disposisi']))) }}
                        </td>
                    </tr>

                    {{-- Baris Disposisi Kabag/KF kepada SKF/Staf --}}
                    @if ($surat->relasiDisposisi->unit_fungsi_teknis)
                        {{-- Cek Jika Kabag/KF Sudah Pernah Disposisi Surat --}}
                        @php
                            $teknis = collect($surat->relasiDisposisi->unit_fungsi_teknis)
                                    -> where('unit_koordinator', auth()->user()->unit_fungsi_id);

                        @endphp

                        @if (count($teknis) > 0)
                            <tr>
                                <td>
                                    {{ \App\Models\UnitFungsi::find((int) $teknis->pluck('unit_koordinator')[0])->nama }}
                                </td>
                                <td>
                                    @if (count($teknis->pluck('unit_penerima')[0]) > 1)
                                        <ul class="pl-3">
                                            @foreach ($teknis->pluck('unit_penerima')[0] as $item)
                                                <li>{{ \App\Models\UnitFungsi::find((int) $item)->nama }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{ \App\Models\UnitFungsi::find((int) $teknis->pluck('unit_penerima')[0][0])->nama }}
                                    @endif
                                </td>
                                <td>
                                    {!! $teknis->pluck('catatan')[0] !!}
                                </td>
                                <td>
                                    @if (count($surat->relasiDisposisi->poin) > 1)
                                        <ul class="pl-3">
                                            @foreach ($surat->relasiDisposisi->poin as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{ $surat->relasiDisposisi->poin[0] }}
                                    @endif
                                </td>
                                <td>
                                    {{ DateFormat::convertDateTime(date("Y-m-d", strtotime($teknis->pluck('tgl_disposisi')[0]))) }}
                                </td>
                            </tr>
                        @endif
                    @endif
                </table>
            </div>
        </div>
    @else
        @include('components.partials.not-found', ['pesan' => 'Belum ada tindak lanjut / disposisi dari surat ini.'])
    @endif
</div>

{{-- Riwayat Pembaca --}}
@if (count($pembaca) > 0)
    <div class="card">
        <div class="card-header">
            <h4>Pegawai yang Telah Membaca Surat Ini</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Dibaca</th>
                        </tr>
                        @foreach ($pembaca as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \App\Models\Pegawai::find($item['id'])->nama }}</td>
                                <td>{{ DateFormat::convertDateTime(date("Y-m-d", strtotime($item['tgl_baca']))) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
