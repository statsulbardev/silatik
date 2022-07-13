<div>
    @switch($tahapan)
        @case('tambah-surat-masuk')
            @include('livewire.main.surat-masuk.template', [
                'tahapan' => 'tambah',
                'metode'  => 'save',
                'judul'   => 'Entri Informasi Surat Masuk'
            ])
            @break
        @case('edit-surat-masuk')
            @include('livewire.main.surat-masuk.template', [
                'tahapan' => 'edit',
                'metode'  => 'update',
                'judul'   => 'Edit Informasi Surat ' . $surat->no_surat
            ])
            @break
    @endswitch
</div>
