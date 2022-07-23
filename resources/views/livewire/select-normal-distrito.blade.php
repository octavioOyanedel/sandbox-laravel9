<div>
    <div class="input-group mb-3">
        <select wire:model.lazy="distrito_id" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
            <option value="" selected>Región...</option>
            @foreach($distritos as $id => $nombre)
                <option value={{$id}}>{{$nombre}}</option>
            @endforeach
        </select>
        <button wire:click=""class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i></button>
    </div> 
</div>
