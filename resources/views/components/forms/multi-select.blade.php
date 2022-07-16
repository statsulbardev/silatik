<div wire:ignore class="form-group">
    <label>{{ $judul }}</label>
    <select class="form-control select2" multiple="multiple">
        @foreach($opsi as $item)
            <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
    </select>
</div>

@push('scripts')
<script>
    $(function() {
        $('.select2').select2().on('change', function() {
            @this.set('{{ $model }}', $(this).val());
        })
    })
</script>
@endpush
