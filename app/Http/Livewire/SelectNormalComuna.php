<?php

namespace App\Http\Livewire;

use App\Models\Comuna;
use Livewire\Component;

class SelectNormalComuna extends Component
{
    public $comuna_id;
    public $comunas = array();

    protected $listeners = ['eProvinciaHaciaComuna'];

    public function eProvinciaHaciaComuna($id)
    {
        $this->comunas = Comuna::where('provincia_id', $id)->pluck('nombre', 'id');
    }

    public function updatedComunaId($id)
    {
        $this->emitUp('eComunaHaciaForm', $id); // envia evento a componente padre
    }

    public function render()
    {
        return view('livewire.select-normal-comuna');
    }
}
