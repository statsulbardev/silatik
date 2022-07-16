<div wire:ignore class="form-group">
    <label>{{ $judul }}</label>
    <select class="form-control select2">
        @if (!is_null($opsi))
            <option wire:key="null" value="null">Pilih salah satu</option>
            @foreach ($opsi as $item)
                <option wire:key="{{ $item->id }}" value="{{ $item->id }}">{{ $item->nama }}</option>
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
</script>
@endpush
