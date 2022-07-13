@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

<div class="form-group">
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
        <input wire:model.defer="{{ $model }}" type="text" class="form-control {{ $model }}">
    </div>
    @error($model)
        <div class="pt-3">
            <span class="text-danger">{{ $message }}</span>
        </div>
    @enderror
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>flatpickr('{{ '.' . $model }}', { dateFormat: "d-M-Y" })</script>
@endpush
