@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

<div class="form-group row">
    <label class="col-sm-2 col-form-label font-weight-bold">
        {{ $judul }}
        @if ($opsi) <sup class="p-1 bg-info rounded text-white">opsional</sup> @endif
    </label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </div>
            </div>
            <input wire:model.defer="{{ $model }}" type="text" class="form-control {{ $model }}">
        </div>
        <div class="mt-3">
            @include('components.notifications.error-field', [
                'model' => $model,
                'pesan' => 'Kolom ini tidak boleh kosong.'
            ])
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>flatpickr('{{ '.' . $model }}', { dateFormat: "d-M-Y" })</script>
@endpush
