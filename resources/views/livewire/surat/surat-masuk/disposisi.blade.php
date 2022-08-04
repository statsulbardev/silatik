@section('title', 'Disposisi ' . str_replace('-',' ',ucwords($judul, '-')))

@section('styles')
<style>
    .card-columns { column-count: 2; !important }
</style>
@endsection

<div>
    <section class="section">
        @include('components.partials.header', [ 'judul' =>  'Disposisi ' . str_replace('-',' ',ucwords($judul, '-')) ])

        @role('kabps')
            @include('livewire.surat.template-disposisi.disposisi-kepala', ['surat' => $surat])
        @endrole

        @role('kabag')
            @include('livewire.surat.template-disposisi.disposisi-kabag', ['surat' => $surat])
        @endrole

        @role('kf')
            @include('livewire.surat.template-disposisi.disposisi-kf', ['surat' => $surat])
        @endrole
    </section>
</div>
