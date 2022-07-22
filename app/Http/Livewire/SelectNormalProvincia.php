<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provincia;

class SelectNormalProvincia extends Component
{
    public $provincia_id;
    public $provincias = array();

    protected $listeners = ['eDistritoHaciaProvincia'];

    public function eDistritoHaciaProvincia($id)
    {
        $this->provincias = Provincia::where('distrito_id', $id)->pluck('nombre', 'id');
    } 

    public function updatedProvinciaId($id)
    {
        $this->emitUp('eProvinciaHaciaForm', $id); // envia evento a componente padre
        $this->emit('eProvinciaHaciaComuna', $id); // envía evento a demas componentes
    }

    public function render()
    {
        return view('livewire.select-normal-provincia');
    }
}
