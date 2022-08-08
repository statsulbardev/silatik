@php
    $surat_baca = \App\Models\SuratBaca::where('surat_id', $item->id);
    $items      = $surat_baca->count();

    if ($items > 0) {
        $data = $surat_baca->pluck('pegawai_id')[0];
        $a = collect($data)->where('id', auth()->user()->id);
    }
@endphp
@if ($items > 0)
    @if ($a->count() > 0)
        <div class="badge badge-primary">
            <i class="fa-solid fa-check"></i>
            Sudah Dibaca
        </div>
    @else
        <div class="badge badge-danger">
            <i class="fa-solid fa-xmark"></i>
            Belum Dibaca
        </div>
    @endif
@else
    <div class="badge badge-danger">
        <i class="fa-solid fa-xmark"></i>
        Belum Dibaca
    </div>
@endif
