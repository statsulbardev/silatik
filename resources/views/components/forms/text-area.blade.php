<div class="form-group">
    <label>
        {!! $judul !!}
        @if(isset($opsi))
            <sup class="p-1 bg-info rounded text-white font-weight-bold">{{ $opsi }}</sup>
        @endif
    </label>
    <div wire:ignore x-data @trix-blur="$dispatch('change', $event.target.value)">
        <trix-editor wire:model.defer="{{ $model }}" class="form-textarea font-weight-light" @if(isset($height)) style="height:{{ $height }}px;overflow-y:auto" @endif></trix-editor>
    </div>
    @error($model)
        <div class="pt-3">
            <span class="text-danger">{{ $message }}</span>
        </div>
    @enderror
</div>

@once('scripts')
    <script>
        (function() {
            addEventListener("trix-initialize", function(e) {
                const file_tools = document.querySelector(".trix-button-group--file-tools");
                file_tools.remove();
            })
            addEventListener("trix-file-accept", function(e) {
                e.preventDefault();
            })
        })();
    </script>
@endonce
