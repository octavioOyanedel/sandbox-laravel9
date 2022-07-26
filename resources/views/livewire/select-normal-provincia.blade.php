<div>
    <div class="input-group mb-3">
        <span class="input-group-text">
            <i class="fa-solid fa-location-dot"></i>
        </span>
        <select wire:model.lazy="provincia_id" class="form-select">
            @if($option_inicial === 0)
                <option value="">Provincia ...</option>
            @endif
            @foreach($arreglo_filtrado as $key => $item)            
                <option value="{{$item['id']}}" wire:key="{{ $item['id'] }}">{{ $item['nombre'] }}</option>
            @endforeach
            @if($option_inicial != 0)
                <option value="">Provincia ...</option>
            @endif            
        </select>
        @if($nueva_provincia)
            <button wire:click="setearFormModal" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalNuevoRegistro"><i class="fa-solid fa-plus"></i></button>
        @endif
    </div>
</div>
