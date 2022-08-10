<div class="form-group row">
    @if (!is_null($judul))
        <label class="font-weight-bold col-sm-2 col-form-label">{{ $judul }}</label>
    @endif
    <div class="col-sm-10">
        <select wire:model.lazy="{{ $model }}" class="form-control">
            @if (!is_null($opsi))
                <option value="null">Pilih salah satu</option>
                @foreach ($opsi as $item)
                    <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
