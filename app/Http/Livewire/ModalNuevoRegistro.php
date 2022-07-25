<?php

namespace App\Http\Livewire;

use App\Rules\Nombre;
use Livewire\Component;
use App\Models\Distrito;

class ModalNuevoRegistro extends Component
{
    // variables a guardar
    public $nombre;
    public $distrito_id;

    public $identificador;
    public $titulo;
    public $provincia;
    public $comuna;

    protected $listeners = ['datosModal'];

    protected $messages = [
        'nombre.required' => 'Debe ingresar nombre de región.',
        'nombre.unique' => 'El nombre ya esta en uso.',
    ];

    public function render()
    {
        return view('livewire.modal-nuevo-registro');
    }

    public function procesarModal()
    {
        switch ($this->identificador) {
            case 1:
                $this->guardarDistrito();
                break;
            case 2:
                $this->guardarProvincia();
                break;
            case 3:
                $this->guardarComuna();
                break;                
        }
    }

    public function datosModal($parametros)
    {
        $this->reset('nombre');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->identificador = $parametros['id'];
        $this->titulo = $parametros['titulo'];
        $this->provincia = $parametros['provincia'];
        $this->comuna = $parametros['comuna'];
    }

    public function guardarDistrito()
    {
        // reglas de validación
        $this->validate([
            'nombre' => ['required', new Nombre, 'unique:distritos,nombre'],
        ]);

        $distrito = Distrito::create([
            'nombre' => $this->nombre
        ]);

        // Cerrar ventana modal
        $this->emit('eventoCerrarModal');

        // Carga de nuevo registro y desplegarlo como seleccionado
        $this->emitTo('select-normal-distrito', 'eventoRefreshDistrito', $distrito->id);

        // Envío de mensaje toastr
        $texto = "Región ".$distrito->nombre." añadida correctamente.";
        $this->emit('eventoRegistroAgregado', $texto); 
    }

    public function guardarProvincia()
    {
        // reglas de validación
        $this->validate([
            'nombre' => ['required', new Nombre, 'unique:provincias,nombre'],
        ]);

        $provincia = Provincia::create([
            'nombre' => $this->nombre,
            'distrito_id' => $this->distrito_id
        ]);

        // Cerrar ventana modal
        $this->emit('eventoCerrarModal');

        // Carga de nuevo registro y desplegarlo como seleccionado
        $this->emitTo('select-normal-provincia', 'eventoRefreshProvincia', $provincia->id);

        // Envío de mensaje toastr
        $texto = "Provincia ".$provincia->nombre." añadida correctamente.";
        $this->emit('eventoRegistroAgregado', $texto); 
    }

    public function guardarComuna()
    {
        dd('save comuna');
    }
    public function limpiarModal()
    {
        $this->reset('nombre');
        $this->resetErrorBag();
        $this->resetValidation();
    }    
}
