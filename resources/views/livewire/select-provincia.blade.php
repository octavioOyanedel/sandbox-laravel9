<div>
    {{-- Provincia --}}
    {{ $key }}
    <div class="mb-3">
        <label for="selectProvincia" class="form-label">Provincia</label>
        <div wire:ignore>
            <select class="form-control mi-select select-provincia" name="state" id="selectProvincia">
                <option value="">...</option>
                {{-- @foreach($www as $id => $nombre)
                    <option value={{$id}}>{{$nombre}}</option>
                @endforeach --}}
            </select>
        </div>       
    </div>
</div>
