<?php
namespace App\Http\Livewire;

use Livewire\Component;

class FormSelectNivel3 extends Component
{
    public $distrito_id;
    public $provincia_id;
    public $comuna_id;

    protected $listeners = [
        'eventoCargarDistritoEnForm',
        'eventoCargarProvinciaEnForm',
        'eventoCargarComunaEnForm',
        'eventoLimpiarProvinciaComuna',
        'eventoLimpiarComuna'
    ];

    public function render()
    {
        return view('livewire.form-select-nivel3');
    }

    public function eventoCargarDistritoEnForm($id)
    {
        $this->distrito_id = $id;
        $this->emitTo('select-normal-provincia', 'eventoEnviarDistritoParaModal', $id);
    }

    public function eventoCargarProvinciaEnForm($id)
    {
        $this->provincia_id = $id;
    }

    public function eventoCargarComunaEnForm($id)
    {
        $this->comuna_id = $id;
    }

    public function eventoLimpiarComuna()
    {
        $this->reset('comuna_id');
    }
    public function eventoLimpiarProvinciaComuna()
    {
        $this->reset(['provincia_id', 'comuna_id']);
    }    
}
