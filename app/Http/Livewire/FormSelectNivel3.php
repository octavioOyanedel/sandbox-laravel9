<?php
namespace App\Http\Livewire;

use Livewire\Component;

class FormSelectNivel3 extends Component
{
    public $distrito;
    public $provincia;
    public $comuna;

    protected $listeners = [
        'eventoEnviarDistritoHaciaForm',
        'eventoEnviarProvinciaHaciaForm'
    ];

    public function eventoEnviarDistritoHaciaForm($id)
    {
        $this->resetDistrito();
        $this->resetProvincia();
        $this->distrito = $id;
    }

    public function eventoEnviarProvinciaHaciaForm($id)
    {
        $this->resetProvincia();
        $this->provincia = $id;
    }

    public function resetDistrito()
    {
        $this->reset('distrito');
    }

    public function resetProvincia()
    {
        $this->reset('provincia');
    }

    public function render()
    {
        return view('livewire.form-select-nivel3');
    }

}
