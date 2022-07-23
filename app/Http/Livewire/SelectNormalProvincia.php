<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provincia;

class SelectNormalProvincia extends Component
{
    // estado inicial botón nuevo
    public $nueva_provincia = false;

    public $provincias = array();
    public $provincia_id;

    public $parametros_modal = array();

    protected $listeners = [
        'eventoCargarProvincias',
        'eventoResetProvincias',
        'eventoActivarNuevaProvincia'
    ];

    public function eventoCargarProvincias($id)
    {
        $this->provincias = Provincia::where('distrito_id', $id)->pluck('nombre', 'id');
    } 

    public function eventoResetProvincias()
    {
        $this->reset();
    }

    public function updatedProvinciaId($id)
    {
        $this->emitUp('eventoLimpiarComuna');
        $this->emitTo('select-normal-comuna', 'eventoResetComunas');
        if($id != ""){
            $this->emitTo('select-normal-comuna', 'eventoCargarComunas', $id);
            $this->emitTo('select-normal-comuna', 'eventoActivarNuevaComuna');
        }
        $this->emitUp('eventoCargarProvinciaEnForm', $id);
    }

    public function eventoActivarNuevaProvincia()
    {
        $this->nueva_provincia = true;
    }

    public function setearFormModal()
    {
        $parametros_modal = array(
             'id' => 2,
             'titulo' => 'Nueva Provincia',
             'provincia' => $this->provincia_id,
             'comuna' => '',
        );
        $this->emitTo('modal-nuevo-registro', 'datosModal', $parametros_modal);
    }

    public function render()
    {
        return view('livewire.select-normal-provincia');
    }
}
