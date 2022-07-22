<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provincia;

class Select2CascadaNivel3 extends Component
{   
    public $distrito;
    public $provincias = [0]; // se debe inicializar para que no sea null
    public $comuna;

    protected $listeners = ['eventoDistrito'];

    public function render()
    {
        return view('livewire.select2-cascada-nivel3');
    }

    public function eventoDistrito($id)
    {
        // dd($id);
        
            $this->distrito = $id;
            // $this->provincias = Provincia::where('distrito_id', $id)->pluck('nombre', 'id');
        
    }
}
