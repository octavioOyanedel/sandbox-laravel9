<div>
    {{-- Distrito --}}
    <div class="mb-3">
        <label for="selectDistrito" class="form-label">Distrito</label>
        <div wire:ignore>
            <select class="form-control mi-select select-distrito" name="state" id="selectDistrito">
                <option value="">...</option>
                @foreach($distritos as $id => $nombre)
                    <option value={{$id}}>{{$nombre}}</option>
                @endforeach
            </select>
        </div>       
    </div>
</div>
