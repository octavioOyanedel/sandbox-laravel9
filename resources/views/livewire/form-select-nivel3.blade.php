<div>
    <form>
        <p>Componente padre: {{$distrito_id}} - {{$provincia_id}} - {{$comuna_id}}</p>
        @livewire('select-normal-distrito')
        @livewire('select-normal-provincia')
        @livewire('select-normal-comuna')
        <div class="input-group mb-3">
            <button class="btn btn-outline-primary" type="button">Enviar</button>
        </div>                      
    </form>
</div>

@livewire('modal-nuevo-registro')