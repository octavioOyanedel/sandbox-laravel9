<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class SelectNormalDistrito extends Component
{
    public $distritos = array();
    public $distrito_id;

    public function mount()
    {
        $this->distritos = Distrito::all()->pluck('nombre', 'id');
    }

    public function updatedDistritoId($id)
    {
        $this->emitUp('eventoLimpiarProvinciaComuna');
        $this->emitTo('select-normal-provincia', 'eventoResetProvincias');
        $this->emitTo('select-normal-comuna', 'eventoResetComunas');
        if($id != ""){
            $this->emitTo('select-normal-provincia', 'eventoCargarProvincias', $id);
            $this->emitTo('select-normal-provincia', 'eventoActivarNuevaProvincia');
        }
        $this->emitUp('eventoCargarDistritoEnForm', $id);
    }

    public function setearFormModal()
    {
        $parametros_modal = array(
            'id' => 1,
            'titulo' => 'Nueva Región',
            'provincia' => '',
            'comuna' => '',
        );        
        $this->emitTo('modal-nuevo-registro', 'datosModal', $parametros_modal);
    }

    public function render()
    {
        return view('livewire.select-normal-distrito');
    }
}
