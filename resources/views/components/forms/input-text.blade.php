<div class="form-group row">
    <label class="col-sm-2 col-form-label font-weight-bold">
        {!! $judul !!}
        @if ($opsi) <sup class="p-1 bg-info rounded text-white">opsional</sup> @endif
    </label>
    <div class="col-sm-10">
        <input wire:model.defer="{{ $model }}" type="{{ $tipe }}" class="form-control">
        <div class="mt-3">
            @include('components.notifications.error-field', [
                'model' => $model,
                'pesan' => 'Kolom ini tidak boleh kosong.'
            ])
        </div>
    </div>
</div>
