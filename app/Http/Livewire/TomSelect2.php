<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provincia;

class TomSelect2 extends Component
{
    public $provincias;

    protected $listeners = ['allaVaElId'];

    public function render()
    {
        return view('livewire.tom-select2');
    }

    public function allaVaElId($id)
    {
        $this->provincias = Provincia::where("distrito_id", $id)->get();
    }
}
