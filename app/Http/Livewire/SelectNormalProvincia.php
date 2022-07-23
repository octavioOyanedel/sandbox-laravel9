<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provincia;

class SelectNormalProvincia extends Component
{
    // estado inicial botón nuevo
    public $nueva_provincia = false;

    public $provincia_id;
    public $provincias = array();

    protected $listeners = [
        'eReiniciarProvinciaComuna' => '$refresh',
        'eDistritoHaciaProvincia',
        'eActivarNuevaProvincia',
        'eDesactivarNuevaProvincia',
    ];

    public function eDistritoHaciaProvincia($id)
    {
        $this->provincias = Provincia::where('distrito_id', $id)->pluck('nombre', 'id');
    } 

    public function updatedProvinciaId($id)
    {
        $this->emitUp('eProvinciaHaciaForm', $id); // envia evento a componente padre
        $this->emit('eProvinciaHaciaComuna', $id); // envía evento a demas componentes
        // switch botón nuevo
        if($id != ""){
            $this->emit('eActivarNuevaComuna');
        }else{
            $this->emitUp('eLimpiarProvinciaComuna');
            $this->emit('eDesactivarNuevaComuna');
        }        
    }

    public function eActivarNuevaProvincia()
    {
        $this->nueva_provincia = true;
    }

    public function eDesactivarNuevaProvincia()
    {
        $this->nueva_provincia = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.select-normal-provincia');
    }
}
