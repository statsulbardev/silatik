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
                    @include('livewire.main.surat.template-daftar-surat.surat-keluar-kepala', [
                        'daftar_surat' => $daftar_surat
                    ])
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
            @case('kabag')
                @if($tipe == 'sm')
                    @include('livewire.main.surat.template-daftar-surat.surat-masuk-kabag', [
                        'daftar_surat' => $daftar_surat
                    ])
                @else
                    @include('livewire.main.surat.template-daftar-surat.surat-keluar-kabag', [
                        'daftar_surat' => $daftar_surat
                    ])
                @endif
                @break
            @case('kf')
                @if ($tipe == 'sm')
                    @include('livewire.main.surat.template-daftar-surat.surat-masuk-kf', [
                        'daftar_surat' => $daftar_surat
                    ])
                @else
                    @include('livewire.main.surat.template-daftar-surat.surat-keluar-kf', [
                        'daftar_surat' => $daftar_surat
                    ])
                @endif
                @break
            @case('skf')
                @if ($tipe == 'sm')
                    @include('livewire.main.surat.template-daftar-surat.surat-masuk-skf', [
                        'daftar_surat' => $daftar_surat
                    ])
                @else
                    @include('livewire.main.surat.template-daftar-surat.surat-keluar-skf', [
                        'daftar_surat' => $daftar_surat
                    ])
                @endif
                @break
            @case('staf')
                @if ($tipe == 'sm')
                    @include('livewire.main.surat.template-daftar-surat.surat-masuk-staf', [
                        'daftar_surat' => $daftar_surat
                    ])
                @else
                    @include('livewire.main.surat.template-daftar-surat.surat-keluar-staf', [
                        'daftar_surat' => $daftar_surat
                    ])
                @endif
                @break
        @endswitch
    </section>
</div>

