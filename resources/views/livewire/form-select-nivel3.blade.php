<div>
    <form>
        <p>Componente padre: {{$distrito}} - {{$provincia}} - {{$comuna}}</p>
        @livewire('select-normal-distrito')
        @livewire('select-normal-provincia')
        {{-- @livewire('select-normal-comuna') --}}
        <div class="input-group mb-3">
            <button class="btn btn-outline-primary" type="button">Enviar</button>
        </div>                      
    </form>

    @livewire('modal-nuevo-registro')
</div>