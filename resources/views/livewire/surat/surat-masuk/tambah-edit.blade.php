<div>
    @switch($tipe)
        @case('sm')
            @switch($action)
                @case('tambah')
                    @include('livewire.surat.input-data', [
                        'tahapan'     => 'tambah',
                        'metode'      => 'create',
                        'judul'       => 'Entri Informasi Surat Masuk',
                        'judul_besar' => 'Surat Masuk'
                    ])
                    @break
                @case('edit')
                    @include('livewire.surat.input-data', [
                        'tahapan'     => 'edit',
                        'metode'      => 'edit',
                        'judul'       => 'Edit Informasi Surat ' . $surat->no_surat,
                        'judul_besar' => 'Surat Masuk'
                    ])
                    @break
            @endswitch

            @break
        @case('sk')
            @switch($action)
                @case('tambah')
                    @include('livewire.surat.input-data', [
                        'tahapan'     => 'tambah',
                        'metode'      => 'create',
                        'judul'       => 'Entri Informasi Surat Keluar'
                    ])
                    @break
                @case('edit')
                    @include('livewire.surat.input-data', [
                        'tahapan'     => 'edit',
                        'metode'      => 'edit',
                        'judul'       => 'Edit Informasi Surat ' . $surat->no_surat
                    ])
                    @break
            @endswitch

            @break
    @endswitch
</div>
