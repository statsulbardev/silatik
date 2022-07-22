@section('title', 'Disposisi ' . str_replace('-',' ',ucwords($judul, '-')))

@section('styles')
<style>
    .card-columns { column-count: 2; !important }
</style>
@endsection

<div>
    <section class="section">
        @include('components.partials.header', [ 'judul' =>  'Disposisi ' . str_replace('-',' ',ucwords($judul, '-')) ])

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
                </div>
            </div>

            {{-- Berkas --}}
            <div class="card">
                <div class="card-header">
                    <h4>Arsip Surat</h4>
                </div>
                <div class="card-body text-center">
                    <div style="width: 22%" class="mb-4 mx-auto">
                        @include('components.icons.pdf-file')
                    </div>
                    <a href="{{ google_view_file($surat->relasiBerkas->sortDesc()->max()->tautan) }}" target="_blank" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-eye"></i>
                        Lihat Berkas
                    </a>
                </div>
            </div>

            {{-- Tindak Lanjut/Disposisi --}}
            <div class="card">
                <form wire:submit.prevent="save">
                    <div class="card-header">
                        <h4>Tindak Lanjut / Disposisi Surat</h4>
                    </div>
                    <div class="card-body">
                        {{-- Poin-poin --}}
                        <div class="row border-bottom mb-4">
                            <div class="col-12 col-md-2 col-lg-2">
                                <span class="font-weight-bold">Poin</span>
                            </div>
                            <div class="col-12 col-md-10 col-lg-10">
                                <div class="row mb-4">
                                    <x-forms.checkbox judul='Untuk Diketahui' model='poin' nilai='Untuk Diketahui' style='col-12 col-md-6 col-lg-6' />
                                    <x-forms.checkbox judul='Ambil Langkah Seperlunya' model='poin' nilai='Ambil Langkah Seperlunya' style='col-12 col-md-6 col-lg-6' />
                                </div>
                                <div class="row mb-4">
                                    <x-forms.checkbox judul='Untuk Diperhatikan' model='poin' nilai='Untuk Diperhatikan' style='col-12 col-md-6 col-lg-6' />
                                    <x-forms.checkbox judul='Dibicarakan' model='poin' nilai='Dibicarakan' style='col-12 col-md-6 col-lg-6' />
                                </div>
                                <div class="row mb-4">
                                    <x-forms.checkbox judul='Untuk Dipelajari' model='poin' nilai='Untuk Dipelajari' style='col-12 col-md-6 col-lg-6' />
                                    <x-forms.checkbox judul='Dilaporkan' model='poin' nilai='Dilaporkan' style='col-12 col-md-6 col-lg-6' />
                                </div>
                                <div class="row mb-4">
                                    <x-forms.checkbox judul='Disiapkan Jawaban' model='poin' nilai='Disiapkan Jawaban' style='col-12 col-md-6 col-lg-6' />
                                    <x-forms.checkbox judul='Segera Diselesaikan' model='poin' nilai='Segera Diselesaikan' style='col-12 col-md-6 col-lg-6' />
                                </div>
                                <div class="row mb-4">
                                    <x-forms.checkbox judul='Jawab Langsung' model='poin' nilai='Jawab Langsung' style='col-12 col-md-6 col-lg-6' />
                                    <x-forms.checkbox judul='Copy Untuk...' model='poin' nilai='Copy Untuk...' style='col-12 col-md-6 col-lg-6' />
                                </div>
                                <div class="row mb-4">
                                    <x-forms.checkbox judul='ACC Untuk Ditindaklanjuti' model='poin' nilai='ACC Untuk Ditindaklanjuti' style='col-12 col-md-6 col-lg-6' />
                                    <x-forms.checkbox judul='Arsip' model='poin' nilai='Arsip' style='col-12 col-md-6 col-lg-6' />
                                </div>
                            </div>
                        </div>

                        {{-- Tujuan Penerima --}}
                        <div class="row border-bottom mb-4">
                            <div class="col-12 col-md-2 col-lg-2">
                                <span class="font-weight-bold">Kepada</span>
                            </div>
                            <div class="col-12 col-md-10 col-lg-10">
                                {{-- Unit Fungsi --}}
                                <div class="row mb-4">
                                    <x-forms.checkbox judul='Bagian Umum' model='penerima' nilai='2' style='col-12 col-md-6 col-lg-6' />
                                    <x-forms.checkbox judul='Fungsi Statistik Sosial' model='penerima' nilai='3' style='col-12 col-md-6 col-lg-6' />
                                </div>
                                <div class="row mb-4">
                                    <x-forms.checkbox judul='Fungsi Statistik Produksi' model='penerima' nilai='4' style='col-12 col-md-6 col-lg-6' />
                                    <x-forms.checkbox judul='Fungsi Statistik Distribusi' model='penerima' nilai='5' style='col-12 col-md-6 col-lg-6' />
                                </div>
                                <div class="row mb-4">
                                    <x-forms.checkbox judul='Fungsi Nerwilis' model='penerima' nilai='6' style='col-12 col-md-6 col-lg-6' />
                                    <x-forms.checkbox judul='Fungsi IPDS' model='penerima' nilai='7' style='col-12 col-md-6 col-lg-6' />
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
