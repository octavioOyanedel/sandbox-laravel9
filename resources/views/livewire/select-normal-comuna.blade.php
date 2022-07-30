<div>
    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-location-dot"></i>
        </span>
        <select wire:model.lazy="comuna" class="form-select">
            @if($posicion_default_option)
                <option value="">Comuna ...</option>
            @endif
            @foreach($arreglo as $key => $item)            
                <option value="{{$item['id']}}" wire:key="{{ $item['id'] }}">{{ $item['nombre'] }}</option>
            @endforeach
            @if(!$posicion_default_option)
                <option value="">Comuna ...</option>
            @endif            
        </select>
        @if($boton_agregar)
            <button wire:click="enviarDatosHaciaModal" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalNuevoRegistro"><i class="fa-solid fa-plus"></i></button>
        @endif
    </div>
</div>