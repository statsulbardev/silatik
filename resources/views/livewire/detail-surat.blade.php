@section('title', 'Surat ' . $tipe .' No. ' . $surat->no_surat)

@section('styles')
<style>
    .card-columns { column-count: 2; !important }
</style>
@endsection

<div>
    <section class="section">
        @include('components.partials.header', ['judul' => 'Surat ' . $tipe . ' No. ' . $surat->no_surat])

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
                                @if ($surat->relasiDisposisi)
                                    <tr>
                                        <td class="font-weight-bold">Kode Paraf</td>
                                        <td width="2%">:</td>
                                        <td>{{ $surat->relasiDisposisi->kode_paraf }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top text-center">
                        <div style="width: 22%" class="my-4 mx-auto">
                            @include('components.icons.pdf-file')
                        </div>
                        <a wire:click="hasRead({{ auth()->user()->id }}, {{ $surat->id }})" href="{{ google_view_file($surat->relasiBerkas->max()->tautan) }}" target="_blank" class="btn btn-icon icon-left btn-primary">
                            <i class="fas fa-eye"></i> Lihat Berkas
                        </a>
                    </div>
                </div>
            </div>

            @switch(strtolower($tipe))
                @case("masuk")
                        {{-- History Tindak Lanjut / Disposisi --}}
                        <div class="card">
                            <div class="card-header">
                                <h4>History Tindak Lanjut / Disposisi</h4>
                            </div>
                            @if (!is_null($surat->relasiDisposisi))
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Dari</th>
                                                <th>Kepada</th>
                                                <th>Ket</th>
                                                <th>Disposisi</th>
                                                <th>Tanggal</th>
                                            </tr>
                                            @if ($surat->relasiDisposisi->unit_fungsi_koordinasi)
                                                {{-- Untuk KF/Kabag --}}
                                                <tr>
                                                    @php
                                                        $koordinator = collect($surat->relasiDisposisi->unit_fungsi_koordinasi[0]);
                                                    @endphp
                                                    <td>
                                                        Kepala {{ \App\Models\UnitKerja::find($surat->unit_kerja_id)->pluck('nama')[0] }}
                                                    </td>
                                                    <td>
                                                        @hasanyrole('kabps|sekretaris')
                                                            <ul class="pl-3">
                                                                @foreach ($surat->relasiDisposisi->unit_fungsi_koordinasi[0]['unit'] as $item)
                                                                    <li>{{ \App\Models\UnitFungsi::where('id', $item)->pluck('nama')[0] }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endhasanyrole

                                                        @hasanyrole('kabag|kf')
                                                            {{ \App\Models\UnitFungsi::where('id', auth()->user()->unit_fungsi_id)->pluck('nama')[0] }}
                                                        @endhasanyrole

                                                        @hasanyrole('skf|staf')
                                                            {{ \App\Models\UnitFungsi::where('id', auth()->user()->relasiUnitFungsi->parent)->pluck('nama')[0] }}
                                                        @endhasanyrole

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
                                                        {{
                                                            DateFormat::convertDateTime(
                                                                date('Y-m-d',
                                                                    strtotime(
                                                                        $surat
                                                                            -> relasiDisposisi
                                                                            -> unit_fungsi_koordinasi[0]['tgl_disposisi']
                                                                    )
                                                                )
                                                            )
                                                        }}
                                                    </td>
                                                </tr>
                                                @hasanyrole('skf|staf')
                                                    {{-- Untuk SKF/Staf --}}
                                                    <tr>
                                                        @php
                                                            $teknis = collect($surat->relasiDisposisi->unit_fungsi_teknis)
                                                                    -> where('unit_koordinator', auth()->user()->relasiUnitFungsi->parent);
                                                        @endphp
                                                        <td>
                                                            {{ \App\Models\UnitFungsi::find((int) $teknis->pluck('unit_koordinator')[0])->nama }}
                                                        </td>
                                                        <td>
                                                            {{ auth()->user()->relasiUnitFungsi->nama }}
                                                        </td>
                                                        <td>

                                                            {!! $teknis->pluck('catatan')[0] !!}
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
                                                            {{ DateFormat::convertDateTime(date("Y-m-d", strtotime($teknis->pluck('tgl_disposisi')[0]))) }}
                                                        </td>
                                                    </tr>
                                                @endhasanyrole
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
                    @break
                @case("keluar")
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
                    @break
            @endswitch
        </div>
    </section>
</div>
