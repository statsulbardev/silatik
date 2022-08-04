@section('title', 'Daftar ' . $judul)

<div>
    <section class="section">
        @include('components.notifications.flash')

        @if (str_contains($nama_routing, "disposisi"))
            @include('components.partials.header', ['judul' => 'Disposisi Surat Masuk'])
        @else
            @include('components.partials.header', ['judul' => 'Kotak Surat Masuk'])
        @endif

        @role('kabps')
            @if ($tipe == 'sm')
                @include('livewire.surat.template-daftar-surat.surat-masuk-kepala', [
                    'daftar_surat' => $daftar_surat
                ])
            @else
                @include('livewire.surat.template-daftar-surat.surat-keluar-kepala', [
                    'daftar_surat' => $daftar_surat
                ])
            @endif
        @endrole

        @role('kabag')
            @if($tipe == 'sm')
                @include('livewire.surat.template-daftar-surat.surat-masuk-kabag', [
                    'daftar_surat' => $daftar_surat
                ])
            @else
                @include('livewire.surat.template-daftar-surat.surat-keluar-kabag', [
                    'daftar_surat' => $daftar_surat
                ])
            @endif
        @endrole

        @role('kf')
            @if ($tipe == 'sm')
                @include('livewire.surat.template-daftar-surat.surat-masuk-kf', [
                    'daftar_surat' => $daftar_surat
                ])
            @else
                @include('livewire.surat.template-daftar-surat.surat-keluar-kf', [
                    'daftar_surat' => $daftar_surat
                ])
            @endif
        @endrole

        @role('skf')
            @if ($tipe == 'sm')
                @include('livewire.surat.template-daftar-surat.surat-masuk-skf', [
                    'daftar_surat' => $daftar_surat
                ])
            @else
                @include('livewire.surat.template-daftar-surat.surat-keluar-skf', [
                    'daftar_surat' => $daftar_surat
                ])
            @endif
        @endrole

        @role('sekretaris')
            @if ($tipe == 'sm')
                @include('livewire.surat.template-daftar-surat.surat-masuk-sekretaris', [
                    'daftar_surat' => $daftar_surat
                ])
            @else
            @endif
        @endrole

        @role('staf')
            @if ($tipe == 'sm')
                @include('livewire.surat.template-daftar-surat.surat-masuk-staf', [
                    'daftar_surat' => $daftar_surat
                ])
            @else
                @include('livewire.surat.template-daftar-surat.surat-keluar-staf', [
                    'daftar_surat' => $daftar_surat
                ])
            @endif
        @endrole
    </section>
</div>

