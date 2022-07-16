@section('title', str_replace('-',' ',ucwords(Route::currentRouteName(), '-')))

@section('styles')
<style>
.card-columns { column-count: 2; !important}
</style>
@endsection

<div>
    <section class="section">
        @include('components.partials.header', [ 'judul' =>  str_replace('-',' ',ucwords(Route::currentRouteName(), '-')) ])

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
                                    <td>{{ $surat->relasiPegawai->relasiUnitFungsi->nama_fungsi }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tindak Lanjut/Disposisi --}}
            <div class="card">
                <div class="card-header">
                    <h4>Tindak Lanjut / Disposisi Surat</h4>
                </div>
                <div class="card-body">
                    <div class="row border-bottom mb-4">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Untuk Diketahui">
                                <label class="form-check-label" for="inlineCheckbox1">1. Untuk Diketahui</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Ambil Langkah Seperlunya">
                                <label class="form-check-label" for="inlineCheckbox1">7. Ambil Langkah Seperlunya</label>
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-4">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Untuk Diperhatikan">
                                <label class="form-check-label" for="inlineCheckbox1">2. Untuk Diperhatikan</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Dibicarakan">
                                <label class="form-check-label" for="inlineCheckbox1">8. Dibicarakan</label>
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-4">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Untuk Dipelajari">
                                <label class="form-check-label" for="inlineCheckbox1">3. Untuk Dipelajari</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Dilaporkan">
                                <label class="form-check-label" for="inlineCheckbox1">9. Dilaporkan</label>
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-4">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Disiapkan Jawaban">
                                <label class="form-check-label" for="inlineCheckbox1">4. Disiapkan Jawaban</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Segera Diselesaikan">
                                <label class="form-check-label" for="inlineCheckbox1">10. Segera Diselesaikan</label>
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-4">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Jawab Langsung">
                                <label class="form-check-label" for="inlineCheckbox1">5. Jawab Langsung</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Copy Untuk...">
                                <label class="form-check-label" for="inlineCheckbox1">11. Copy Untuk...</label>
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-4">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="ACC Untuk Ditindaklanjuti">
                                <label class="form-check-label" for="inlineCheckbox1">6. ACC Untuk Ditindaklanjuti</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-check form-check-inline">
                                <input wire:model.defer="poin" class="form-check-input" type="checkbox" value="Arsip">
                                <label class="form-check-label" for="inlineCheckbox1">12. Arsip</label>
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-4">
                        <div class="col-12 col-md-3 col-lg-2">
                            <span class="font-weight-bold">Kepada</span>
                        </div>
                        <div class="col-12 col-md-10 col-lg-10">
                            {{-- @php
                                $unitKerja = \App\Models\UnitKerja::get(['id', 'nama']);

                                $data = \App\Models\Pegawai::get(['id', 'nama']);
                            @endphp --}}
                            {{-- Unit Kerja --}}
                            <x-forms.select judul='Unit Kerja' model='unitKerja' :opsi="$daftarUnitKerja" />

                            {{-- Unit Fungsi --}}
                            <x-forms.select judul='Unit Fungsi' model='unitFungsi' :opsi="$daftarUnitFungsi" />

                            {{-- Daftar Pegawai --}}
                            {{-- <x-forms.multi-select judul='Nama Pegawai' model='penerima' :opsi="$data" /> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <span class="font-weight-bold">Keterangan</span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <textarea class="form-control" style="height: 70px"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-secondary text-right">
                    <button type="button" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim
                    </button>
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
                    <a href="{{ google_view_file($surat->relasiBerkasSurat->max()->tautan) }}" target="_blank" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-eye"></i>
                        Lihat Berkas
                    </a>
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
                            <tr></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
