@section('title', $judul)

<section class="section">
    @include('components.partials.header', [ 'judul' => $judul ])

    <form wire:submit.prevent="{{ $metode }}">
        <div class="card">
            <div class="card-body">
                {{-- Nomor Agenda --}}
                <x-forms.input-text judul='Nomor Agenda' model='no_agenda' tipe='number' />

                {{-- Tanggal Surat --}}
                <x-forms.input-date judul='Tanggal Surat' model='tanggal_surat' />

                {{-- Nomor Surat --}}
                <x-forms.input-text judul='Nomor Surat' model='no_surat' tipe='text' />

                {{-- Pengirim Surat --}}
                <x-forms.input-text judul='Pengirim Surat' model='pengirim_surat' tipe='text' />

                {{-- Perihal Surat --}}
                <x-forms.text-area judul='Perihal Surat' model='perihal_surat' />

                {{-- Tingkat Keamanan Surat --}}
                <x-forms.select judul='Tingkat Keamanan Surat' model='tk_keamanan' :opsi="$daftarTkKeamanan" />

                {{-- File Surat --}}
                <x-forms.file-upload judul='Unggah Berkas Surat' model='file_surat' />

                {{-- Berkas Surat Sebelumnya --}}
                @if ($tahapan === 'edit')
                    <a href="{{ google_view_file($surat->relasiBerkas->max()->tautan) }}" target="_blank" class="btn btn-icon icon-left btn-success">
                        <i class="fas fa-eye"></i>
                        Link Berkas Surat Sebelumnya
                    </a>
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
