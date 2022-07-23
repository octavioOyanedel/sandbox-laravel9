<?php

namespace App\Http\Livewire;

use App\Models\Comuna;
use Livewire\Component;

class SelectNormalComuna extends Component
{
    // estado inicial botón nuevo
    public $nueva_comuna = false;

    public $comuna_id;
    public $comunas = array();

    protected $listeners = [
        'xxx' => '$refresh',
        'eProvinciaHaciaComuna',
        'eActivarNuevaComuna',
        'eDesactivarNuevaComuna',
    ];

    public function eProvinciaHaciaComuna($id)
    {
        $this->comunas = Comuna::where('provincia_id', $id)->pluck('nombre', 'id');
    }

    public function updatedComunaId($id)
    {
        $this->emitUp('eComunaHaciaForm', $id); // envia evento a componente padre
    }

    public function eActivarNuevaComuna()
    {
        $this->nueva_comuna = true;
    }

    public function eDesactivarNuevaComuna()
    {
        $this->nueva_comuna = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.select-normal-comuna');
    }
}
