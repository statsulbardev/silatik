@section('title', $judul_besar)

<section class="section">
    @include('components.partials.header', [ 'judul' => $judul_besar ])

    <form wire:submit.prevent="{{ $metode }}">
        <div class="card">
            <div class="card-header">
                <h4>{{ $judul }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-9 col-lg-9 pr-4">
                        {{-- Nomor Agenda --}}
                        <x-forms.input-text judul='Nomor Agenda' model='no_agenda' tipe='number' />

                        {{-- Tanggal Surat --}}
                        <x-forms.input-date judul='Tanggal Surat' model='tanggal_surat' />

                        {{-- Nomor Surat --}}
                        <x-forms.input-text judul='Nomor Surat' model='no_surat' tipe='text' />

                        @if ($tipe === "sm")
                            {{-- Pengirim Surat --}}
                            <x-forms.input-text judul='Pengirim Surat' model='pengirim_surat' tipe='text' />
                        @endif

                        {{-- Perihal Surat --}}
                        <x-forms.text-area judul='Perihal Surat' model='perihal_surat' />

                        @if ($tipe === "sm")
                            {{-- Tingkat Keamanan Surat --}}
                            <x-forms.select judul='Tingkat Keamanan Surat' model='tk_keamanan' :opsi="$daftarTkKeamanan" />
                        @else
                            <x-forms.multi-select judul='Unit Kerja Tujuan' model='unitKerja' placeholder='Pilih Unit Kerja' :opsi="$daftarUnitKerja" />

                            {{-- Unit Fungsi --}}
                            <label style="font-weight:600;color:#34395e;font-size:12px;letter-spacing:0.5px;" class="mb-3">Unit Fungsi Tujuan(Opsional)</label>
                            <div class="row mb-4">
                                <x-forms.checkbox judul='Bagian Umum' model='unitFungsi' nilai='2' style='col-12 col-md-6 col-lg-6' />
                                <x-forms.checkbox judul='Fungsi Statistik Sosial' model='unitFungsi' nilai='3' style='col-12 col-md-6 col-lg-6' />
                            </div>
                            <div class="row mb-4">
                                <x-forms.checkbox judul='Fungsi Statistik Produksi' model='unitFungsi' nilai='4' style='col-12 col-md-6 col-lg-6' />
                                <x-forms.checkbox judul='Fungsi Statistik Distribusi' model='unitFungsi' nilai='5' style='col-12 col-md-6 col-lg-6' />
                            </div>
                            <div class="row mb-4">
                                <x-forms.checkbox judul='Fungsi Nerwilis' model='unitFungsi' nilai='6' style='col-12 col-md-6 col-lg-6' />
                                <x-forms.checkbox judul='Fungsi IPDS' model='unitFungsi' nilai='7' style='col-12 col-md-6 col-lg-6' />
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        {{-- File Surat --}}w
                        <div class="bg-whitesmoke text-center border rounded">
                            <p class="mt-3 font-weight-bold">Unggah Berkas Surat</p>
                            <i class="fa-solid fa-cloud-upload mb-4" style="font-size:8em"></i>
                            <div class="mb-3">
                                <label class="btn btn-primary btn-file">
                                    Unggah Surat <input wire:model.defer="file_surat" type="file" style="display: none;" required>
                                </label>
                            </div>
                            <div wire:loading wire:target="file_surat" class="mb-3 text-center">
                                <lottie-player class="mx-auto" src="https://assets5.lottiefiles.com/packages/lf20_5qduppq9.json"  background="transparent"  speed="1"  style="width: 100px; height: 50px;"  loop  autoplay></lottie-player>
                                Berkas surat sedang dimuat ...
                            </div>
                            @if ($file_surat)
                                <p class="px-4" class="font-weight-bold">{{ $file_surat->getFileName() }}</p>
                            @endif
                        </div>

                        {{-- Berkas Surat Sebelumnya --}}
                        @if ($tahapan === 'edit')
                            <a href="{{ google_view_file($surat->relasiBerkas->max()->tautan) }}" target="_blank" class="btn btn-icon icon-left btn-success">
                                <i class="fas fa-eye"></i>
                                Link Berkas Surat Sebelumnya
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @if ($file_surat)
                <div class="card-footer bg-secondary text-right">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            @endif
        </div>
    </form>
</section>

@push('scripts')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endpush
