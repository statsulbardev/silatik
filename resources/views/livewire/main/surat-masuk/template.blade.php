@section('title', $judul)

<section class="section">
    @include('components.partials.header', [ 'judul' => $judul ])

    <form wire:submit.prevent="{{ $metode }}">
        <div class="card">
            <div class="card-body">
                {{-- Nomor Agenda --}}
                <x-forms.input-text judul='Nomor Agenda' model='no_agenda' />

                {{-- Tanggal Surat --}}
                <x-forms.input-date judul='Tanggal Surat' model='tanggal_surat' />

                {{-- Nomor Surat --}}
                <x-forms.input-text judul='Nomor Surat' model='no_surat' />

                {{-- Pengirim Surat --}}
                <x-forms.input-text judul='Pengirim Surat' model='pengirim_surat' />

                {{-- Perihal Surat --}}
                <x-forms.text-area judul='Perihal Surat' model='perihal_surat' />

                {{-- File Surat --}}
                <x-forms.file-upload judul='Unggah Berkas Surat' model='file_surat' />
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit">Simpan</button>
                <button class="btn btn-secondary" type="reset">Batal</button>
            </div>
        </div>
    </form>
</section>
