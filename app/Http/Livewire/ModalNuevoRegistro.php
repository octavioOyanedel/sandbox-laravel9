<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalNuevoRegistro extends Component
{
    public $identificador;
    public $titulo;
    public $provincia;
    public $comuna;
    public $nombre;

    protected $listeners = ['datosModal'];

    public function render()
    {
        return view('livewire.modal-nuevo-registro');
    }

    public function procesarModal()
    {
        switch ($this->identificador) {
            case 1:
                $this->guardarDistrito();
                break;
            case 2:
                $this->guardarProvincia();
                break;
            case 3:
                $this->guardarComuna();
                break;                
        }
    }

    public function datosModal($parametros)
    {
        $this->reset('nombre');
        $this->identificador = $parametros['id'];
        $this->titulo = $parametros['titulo'];
        $this->provincia = $parametros['provincia'];
        $this->comuna = $parametros['comuna'];
    }

    public function guardarDistrito()
    {
        dd('save distrito');
    }

    public function guardarProvincia()
    {
        dd('save provincia');
    }

    public function guardarComuna()
    {
        dd('save comuna');
    }
    public function limpiarModal()
    {
        $this->reset('nombre');
        $this->resetErrorBag();
        $this->resetValidation();
    }    
}
