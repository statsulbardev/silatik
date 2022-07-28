<div class="form-group">
    <label>
        {!! $judul !!}
        @if(isset($opsi))
            <sup class="p-1 bg-info rounded text-white font-weight-bold">{{ $opsi }}</sup>
        @endif
    </label>
    <textarea wire:model.defer="{{ $model }}" class="form-control" style="height: 80px"></textarea>
    @error($model)
        <div class="pt-3">
            <span class="text-danger">{{ $message }}</span>
        </div>
    @enderror
</div>
