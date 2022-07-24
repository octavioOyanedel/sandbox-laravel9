<div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-location-dot"></i></span>
        <select wire:model.lazy="distrito_id" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
            @if($identificador === 0)
                <option value="">Región ...</option>
            @endif
            @foreach($distritos as $distrito)                
                <option value="{{$distrito->id}}" wire:key="{{ $distrito->id }}">{{$distrito->nombre}}</option>                
            @endforeach
        </select>
        <button wire:click="setearFormModal" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalNuevoRegistro"><i class="fa-solid fa-plus"></i></button>
    </div> 
</div>
