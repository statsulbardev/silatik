<div>
    @switch($action)
        @case('tambah')
            @include('livewire.main.surat.template', [
                'tahapan'     => 'tambah',
                'metode'      => 'create',
                'judul'       => 'Entri Informasi Surat Masuk'
            ])
            @break
        @case('edit')
            @include('livewire.main.surat.template', [
                'tahapan'     => 'edit',
                'metode'      => 'edit',
                'judul'       => 'Edit Informasi Surat ' . $surat->no_surat
            ])
            @break
    @endswitch
</div>
