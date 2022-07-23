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
        $this->emitUp('eDistritoHaciaForm', $id);
        $this->emit('eDistritoHaciaProvincia', $id);

        $this->emitTo('select-normal-comuna','xxx');

        // switch botón nuevo
        if($id != ""){
            $this->emit('eActivarNuevaProvincia');                 
        }else{
            $this->emitUp('eLimpiarProvinciaComuna');
            $this->emit('eDesactivarNuevaProvincia');
            $this->emit('eDesactivarNuevaComuna');
        }
    }

    public function render()
    {
        return view('livewire.select-normal-distrito');
    }
}
