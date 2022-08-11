@error($model)
    <div class="alert alert-danger mb-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" wire:key="{{ rand() }}">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span>{{ $pesan }}</span>
    </div>
@enderror
