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
        'eventoEnviarProvinciaHaciaForm',
        'eventoEnviarComunaHaciaForm',
        'eventoResetDisProCom'
    ];

    // eventos

    public function eventoResetDisProCom()
    {
        $this->reset();
    }

    public function eventoEnviarDistritoHaciaForm($id)
    {
        $this->reset('distrito');
        $this->distrito = $id;
    }

    public function eventoEnviarProvinciaHaciaForm($id)
    {
        $this->reset('provincia');
        $this->provincia = $id;
    }

    public function eventoEnviarComunaHaciaForm($id)
    {
        $this->reset('comuna');
        $this->comuna = $id;
    }

    public function render()
    {
        return view('livewire.form-select-nivel3');
    }

}
