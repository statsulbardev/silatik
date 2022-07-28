<div class="form-group">
    <label>
        {{ $judul }}
        @if ($opsi) <sup class="p-1 bg-info rounded text-white">opsional</sup> @endif
    </label>
    <input wire:model.defer="{{ $model }}" type="file" class="form-control" enctype="multipart/form-data">
    @error($model)
        <div class="pt-3">
            <span class="text-danger">{{ $message }}</span>
        </div>
    @enderror
  </div>
