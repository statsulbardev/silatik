<div class="bg-whitesmoke text-center border rounded">
    <p class="mt-3 font-weight-bold">{{ $judul }}</p>
    <i class="fa-solid fa-cloud-upload mb-4" style="font-size:8em"></i>
    <div class="selectFile">
        <label class="btn btn-primary btn-file">
            Unggah Surat <input wire:model.defer="{{ $model }}" type="file" style="display: none;" required>
        </label>
    </div>
    <div wire:loading wire:target="{{ $model }}" class="mt-3">
        Berkas surat sedang dimuat ...
    </div>
    @if ($model)
        <p wire:loading.remove class="font-weight-bold" class="mt-3">{{ $model->getFileName() }}</p>
    @endif
</div>
