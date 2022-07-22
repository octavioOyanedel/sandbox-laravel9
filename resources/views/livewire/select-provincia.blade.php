<div>
    {{-- Provincia --}}
    <div class="mb-3">
        <label for="selectProvincia" class="form-label">Provincia</label>
        <div wire:ignore>
            <select class="form-control mi-select select-provincia" name="state" id="selectProvincia">
                <option value="">...</option>
                @if($provincias)
                    @foreach($provincias as $provincia)
                        <option value={{$provincia->id}}>{{$provincia->nombre}}</option>
                    @endforeach
                @endif
            </select>
        </div>       
    </div>
</div>
