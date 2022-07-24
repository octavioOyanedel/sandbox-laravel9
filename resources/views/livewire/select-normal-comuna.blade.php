<div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-location-dot"></i></span>
        <select wire:model.lazy="comuna_id" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
            <option value="" selected>Comuna ...</option>
            @foreach($comunas as $id => $nombre)
                <option value={{$id}}>{{$nombre}}</option>
            @endforeach
        </select>
        @if($nueva_comuna)
            <button wire:click="setearFormModal" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalNuevoRegistro"><i class="fa-solid fa-plus"></i></button>
        @endif
    </div> 
</div>
