@section('title', 'Surat Masuk No. ' . $surat->no_surat)

<div>
    <section class="section">
        @include('components.partials.header', ['judul' => 'Surat Masuk No. ' . $surat->no_surat])

        {{-- Informasi Surat --}}
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Surat</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-9 col-lg-9">
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
                            </div>
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="pt-4 text-center">
                                    <div style="width: 45%" class="my-4 mx-auto">
                                        @include('components.icons.pdf-file')
                                    </div>
                                    <a wire:click="hasRead({{ auth()->user()->id }}, {{ $surat->id }})" href="{{ google_view_file($surat->relasiBerkas->max()->tautan) }}" target="_blank" class="btn btn-icon icon-left btn-primary">
                                        <i class="fas fa-eye"></i> Lihat Berkas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @role('kabps')
            @include('livewire.surat.template-detail-surat.detail-surat-masuk-kepala', ['surat' => $surat])
        @endrole

        @role('kabag')
            @include('livewire.surat.template-detail-surat.detail-surat-masuk-kabag', ['surat' => $surat])
        @endrole

        @role('kf')
            @include('livewire.surat.template-detail-surat.detail-surat-masuk-kf', ['surat' => $surat])
        @endrole

        @role('skf')
            @include('livewire.surat.template-detail-surat.detail-surat-masuk-skf', ['surat' => $surat])
        @endrole

        @role('sekretaris')
            @include('livewire.surat.template-detail-surat.detail-surat-masuk-sekretaris', ['surat' => $surat])
        @endrole

        @role('staf')
            @include('livewire.surat.template-detail-surat.detail-surat-masuk-staf', ['surat' => $surat])
        @endrole
    </section>
</div>
