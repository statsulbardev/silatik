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

{{-- Riwayat Pemeriksaan --}}
<div class="card">
    <div class="card-header">
        <h4>Riwayat Pemeriksaan</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Status</th>
                    <th>Pemeriksa</th>
                    <th>Tanggal</th>
                </tr>
                <tr>
                    <td>
                        <span class="badge {{
                            [
                                "op" => "badge-primary",
                                "tp" => "badge-danger",
                                "bp" => "badge-warning"
                            ][$surat->relasiPemeriksaan->sortDesc()->max()->cek_kf]
                        }}">
                            {{
                                [
                                    "op" => "Diterima",
                                    "tp" => "Ditolak",
                                    "bp" => "Belum Diperiksa"
                                ][$surat->relasiPemeriksaan->sortDesc()->max()->cek_kf]
                            }}
                        </span>
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
                            is_null($surat->relasiPemeriksaan->sortDesc()->max()->tgl_cek_kf)
                                ? '-'
                                : DateFormat::convertDateTime($surat->relasiPemeriksaan->sortDesc()->max()->tgl_cek_kf)
                        }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="badge {{
                            [
                                "op" => "badge-primary",
                                "tp" => "badge-danger",
                                "bp" => "badge-warning"
                            ][$surat->relasiPemeriksaan->sortDesc()->max()->cek_kepala]
                        }}">
                            {{
                                [
                                    "op" => "Diterima",
                                    "tp" => "Ditolak",
                                    "bp" => "Belum Diperiksa"
                                ][$surat->relasiPemeriksaan->sortDesc()->max()->cek_kepala]
                            }}
                        </span>
                    </td>
                    <td>
                        {{ \App\Models\Pegawai::where('unit_kerja_id', 1)->where('unit_fungsi_id', 1)->pluck('nama')[0] }}
                    </td>
                    <td>
                        {{
                            is_null($surat->relasiPemeriksaan->sortDesc()->max()->tgl_cek_kepala)
                                ? '-'
                                : DateFormat::convertDateTime($surat->relasiPemeriksaan->sortDesc()->max()->tgl_cek_kepala)
                        }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

{{-- History Pemeriksaan --}}
{{-- <div class="card">
    <div class="card-header">
        <h4>History Pemeriksaan</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Dari</th>
                    <th>Kepada</th>
                    <th>Ket</th>
                </tr>
                @if ($surat->relasiDisposisi)
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
                @endif
            </table>
        </div>
    </div>
</div> --}}
