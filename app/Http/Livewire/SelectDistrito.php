<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class SelectDistrito extends Component
{
    public $distritos;

    protected $listeners = ['eventoSelectDistrito'];

    public function mount()
    {
        $this->distritos = Distrito::all()->pluck('nombre', 'id');
        // $distritos = Distrito::all()->pluck('nombre', 'id')->dd();
        // pluck retorna arreglo
        /*^ array:2 [▼
          1 => "Valparaíso"
          2 => "Región Metropolitana"
        ]*/
    }

    public function render()
    {
        return view('livewire.select-distrito');
    }

    public function eventoSelectDistrito($id)
    {
        $this->emit('eventoDistrito', $id);
    }
}
