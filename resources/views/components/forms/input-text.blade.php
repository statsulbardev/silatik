<div class="form-group row">
    <label class="col-sm-2 col-form-label font-weight-bold">
        {!! $judul !!}
        @if ($opsi) <sup class="p-1 bg-info rounded text-white">opsional</sup> @endif
    </label>
    <div class="col-sm-10">
        <input wire:model.defer="{{ $model }}" type="{{ $tipe }}" class="form-control">
        @error($model)
            <div class="pt-3">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
    </div>
</div>
