<div wire:ignore class="form-group">
    <label>
        {{ $judul }}
        @if ($opsi) <sup class="p-1 bg-info rounded text-white">opsional</sup> @endif
    </label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-calendar"></i>
            </div>
        </div>
        <input wire:model.defer="{{ $model }}" type="text" class="form-control datepicker">
      </div>
</div>
