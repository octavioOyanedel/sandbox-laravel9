<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormSelectNivel3 extends Component
{
    public $distrito_id;
    public $provincia_id;
    public $comuna_id;

    protected $listeners = [
        'eDistritoHaciaForm',
        'eProvinciaHaciaForm',
        'eComunaHaciaForm'
    ];

    public function render()
    {
        return view('livewire.form-select-nivel3');
    }

    public function eDistritoHaciaForm($id)
    {
        $this->distrito_id = $id;
    }

    public function eProvinciaHaciaForm($id)
    {
        $this->provincia_id = $id;
    }

    public function eComunaHaciaForm($id)
    {
        $this->comuna_id = $id;
    }
}
