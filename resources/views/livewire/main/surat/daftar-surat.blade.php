@section('title', 'Daftar ' . $judul)

<div>
    <section class="section">
        @include('components.notifications.flash')

        @include('components.partials.header', [ 'judul' =>  $judul])

        @switch($role)
            @case('kabps')
                @if ($tipe == 'sm')
                    @include('livewire.main.surat.template-daftar-surat.surat-masuk-kepala', [
                        'daftar_surat' => $daftar_surat
                    ])
                @else
                @endif
                @break
            @case('sekretaris')
                @if ($tipe == 'sm')
                    @include('livewire.main.surat.template-daftar-surat.surat-masuk-sekretaris', [
                        'daftar_surat' => $daftar_surat
                    ])
                @else
                @endif
                @break
            @case('kf')
                @if ($tipe == 'sm')
                    @include('livewire.main.surat.template-daftar-surat.surat-masuk-kf', [
                        'daftar_surat' => $daftar_surat
                    ])
                @else
                @endif
                @break
            @case('staf')
                @if ($tipe == 'sm')
                @else
                    @include('livewire.main.surat.template-daftar-surat.surat-keluar-staf', [
                        'daftar_surat' => $daftar_surat
                    ])
                @endif
                @break
            @default

        @endswitch
    </section>
</div>

