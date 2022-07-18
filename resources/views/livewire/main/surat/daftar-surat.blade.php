@section('title', 'Daftar ' . str_replace('-',' ',ucwords($routing, '-')))

<div>
    <section class="section">
        @include('components.notifications.flash')

        @include('components.partials.header', [ 'judul' =>  str_replace('-',' ',ucwords($routing, '-')) ])

        @switch($role)
            @case('kabps')
                @include('livewire.main.surat.template-daftar-surat.template-kepala', [
                    'daftar_surat' => $daftar_surat
                ])
                @break
            @case('sekretaris')
                @include('livewire.main.surat.template-daftar-surat.template-sekretaris', [
                    'daftar_surat' => $daftar_surat
                ])
                @break
            @default

        @endswitch
    </section>
</div>

