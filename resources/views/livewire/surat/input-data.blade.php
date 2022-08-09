@section('title', $judul)

<section class="section">
    @include('components.partials.header', [ 'judul' => $judul ])

    <form wire:submit.prevent="{{ $metode }}">
        <div class="card">
            <div class="card-body">
                {{-- File Surat --}}
                <x-forms.file-upload judul='Unggah Berkas Surat' model='file_surat' />

                {{-- Berkas Surat Sebelumnya --}}
                @if ($tahapan === 'edit')
                    <a href="{{ google_view_file($surat->relasiBerkas->max()->tautan) }}" target="_blank" class="btn btn-icon icon-left btn-success">
                        <i class="fas fa-eye"></i>
                        Link Berkas Surat Sebelumnya
                    </a>
                @endif

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
            <div class="card-footer text-right">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </div>
    </form>
</section>
