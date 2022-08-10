<div class="form-group row">
    <label class="font-weight-bold col-sm-2 col-form-label">
        {!! $judul !!}
        @if(isset($opsi))
            <sup class="p-1 bg-info rounded text-white font-weight-bold">{{ $opsi }}</sup>
        @endif
    </label>
    <div class="col-sm-10">
        <textarea wire:model.defer="{{ $model }}" class="form-control" style="height: 80px"></textarea>
        @error($model)
            <div class="pt-3">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror
    </div>
</div>
