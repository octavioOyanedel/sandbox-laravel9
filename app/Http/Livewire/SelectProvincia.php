<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provincia;

class SelectProvincia extends Component
{
    public $provincias;

    protected $listeners = ['eventoDistrito'];

    public function render()
    {
        return view('livewire.select-provincia');
    }

    public function eventoDistrito($id)
    {
        // dd($id);
        $provincias = Provincia::where('distrito_id', $id)->get();
        // $this->provincias = $provincias->pluck('nombre', 'id')->toarray();
        $this->provincias = $provincias;
        // dd($provincias->pluck('nombre', 'id')->toarray());
        // $this->provincias = $provincias->pluck('nombre', 'id'); 
        // dd($this->provincias); 
    }  
}
