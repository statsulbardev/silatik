<div class="form-group">
    @if (!is_null($judul))
        <label>{{ $judul }}</label>
    @endif
    <select wire:model.lazy="{{ $model }}" class="form-control">
        @if (!is_null($opsi))
            <option value="null">Pilih salah satu</option>
            @foreach ($opsi as $item)
                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
            @endforeach
        @endif
    </select>
</div>
