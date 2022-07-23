<div>
    <div class="input-group mb-3">
        <select wire:model.lazy="comuna_id" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
            <option value="" selected>Comuna...</option>
            @foreach($comunas as $id => $nombre)
                <option value={{$id}}>{{$nombre}}</option>
            @endforeach
        </select>
        @if($nueva_comuna)
            <button class="btn btn-outline-success" type="button"><i class="fa-solid fa-plus"></i></button>
        @endif
    </div> 
</div>
