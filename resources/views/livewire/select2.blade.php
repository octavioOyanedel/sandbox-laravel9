<div>
    {{ empty($comuna) ? '-' : $comuna->nombre }}
    <div wire:ignore>
        <select class="form-control mi-select" name="state" id="select2">
            <option value="">...</option>
            {{-- @foreach($users as $user)
                <option value={{$user->id}}>{{$user->nombre1}}</option>
            @endforeach --}}
            @foreach($comunas as $comuna)
                <option value={{$comuna->id}}>{{$comuna->nombre}}</option>
            @endforeach
        </select>
    </div>    
</div>
