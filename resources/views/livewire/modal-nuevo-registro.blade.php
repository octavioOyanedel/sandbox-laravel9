<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">{{$titulo}}</h5>
                    <button wire:click="limpiarModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="inputGroup-sizing-default">Nombre</span>
                      <input wire:model="nombre" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="limpiarModal" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button wire:click="procesarModal" type="button" class="btn btn-outline-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
