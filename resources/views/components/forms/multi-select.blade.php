<div wire:ignore class="form-group">
    <label>{{ $judul }}</label>
    <select wire:model.lazy="{{ $model }}" class="form-control js-placeholder select2" multiple="multiple">
        @if (!is_null($opsi))
            @foreach ($opsi as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        @endif
    </select>
</div>

@push('scripts')
<script>
    $(function() {
        $('.select2').select2().on('change', function() {
            @this.set('{{ $model }}', $(this).val());
        })
    })
    $(function() {
        $('.js-placeholder').select2({
            placeholder: '{{ $placeholder }}',
            allowClear: true
        })
    })
</script>
@endpush
