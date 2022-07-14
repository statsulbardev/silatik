<div>
    @switch($tahapan)
        @case('tambah-surat-masuk')
            @include('livewire.main.surat.template', [
                'tahapan'     => 'tambah',
                'metode'      => 'create',
                'judul'       => 'Entri Informasi Surat Masuk'
            ])
            @break
        @case('edit-surat-masuk')
            @include('livewire.main.surat.template', [
                'tahapan'     => 'edit',
                'metode'      => 'edit',
                'judul'       => 'Edit Informasi Surat ' . $surat->no_surat
            ])
            @break
        @case('tambah-surat-keluar')
            @include('livewire.main.surat.template', [
                'tahapan'     => 'tambah',
                'metode'      => 'create',
                'judul'       => 'Entri Informasi Surat Keluar'
            ])
            @break
        @case('edit-surat-keluar')
            @include('livewire.main.surat.template', [
                'tahapan'     => 'edit',
                'metode'      => 'edit',
                'judul'       => 'Edit Informasi Surat ' . $surat->no_surat
            ])
            @break
    @endswitch
</div>
