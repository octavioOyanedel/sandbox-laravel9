<?php

namespace App\Http\Livewire;

use App\Models\Comuna;
use Livewire\Component;

class SelectNormalComuna extends Component
{
    // estado inicial botón nuevo
    public $nueva_comuna = false;

    public $comunas = array();
    public $comuna_id;

    protected $listeners = [
        'eventoCargarComunas',
        'eventoResetComunas',
        'eventoActivarNuevaComuna'
    ];

    public function eventoCargarComunas($id)
    {
        $this->comunas = Comuna::where('provincia_id', $id)->pluck('nombre', 'id');
    }

    public function eventoResetComunas()
    {
        $this->reset();
    }

    public function updatedComunaId($id)
    {
        $this->comuna_id = $id;
        $this->emitUp('eventoCargarComunaEnForm', $id);
    }

    public function eventoActivarNuevaComuna()
    {
        $this->nueva_comuna = true;
    }

    public function setearFormModal()
    {
        $parametros_modal = array(
            'id' => 3,
            'titulo' => 'Nueva Comuna',
            'provincia' => '',
            'comuna' => $this->comuna_id,
        );        
        $this->emitTo('modal-nuevo-registro', 'datosModal', $parametros_modal);
    }

    public function render()
    {
        return view('livewire.select-normal-comuna');
    }
}
