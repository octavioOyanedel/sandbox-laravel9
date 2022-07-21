<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Comuna;
use Livewire\Component;
use App\Models\Distrito;
use App\Models\Provincia;

class Select2 extends Component
{
    public $users;
    public $distritos; 
    public $provincias;
    public $comunas;

    public $comuna;

    protected $listeners = ['select2'];

    public function mount() 
    {
        $this->users = User::all();
        $this->provincias = Provincia::all();
        $this->distritos = Distrito::all();
        $this->comunas = Comuna::all();
    }

    public function render()
    {
        return view('livewire.select2');
    }

    public function select2($id)
    {
        $comuna = Comuna::find($id);
        if(empty($comuna)){
            dd("Vacío o Null");
        }else{
            $this->comuna = $comuna;
        }      
    }
}
