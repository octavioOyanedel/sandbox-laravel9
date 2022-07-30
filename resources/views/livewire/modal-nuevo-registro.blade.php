<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalNuevoRegistro" tabindex="-1" aria-labelledby="modalNuevoRegistroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$titulo}}</h5>
                    <button wire:click="limpiarModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                        <input wire:model="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre"> 
                    </div>
                    @error('nombre')
                        <small class="ms-2 text-danger fw-bolder fst-italic">Error: {{$message}}</small>
                    @enderror                    
                </div>
                <div class="modal-footer">
                    <button wire:click="limpiarModal" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button wire:click="guardarRegistro" type="button" class="btn btn-outline-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>