<div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-location-dot"></i></span>
        <select wire:model.lazy="provincia_id" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
            <option value="" selected>Provincia ...</option>
            @foreach($provincias as $id => $nombre)
                <option value={{$id}}>{{$nombre}}</option>
            @endforeach
        </select>
        @if($nueva_provincia)
            <button wire:click="setearFormModal" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i></button>
        @endif
    </div>
</div>
