<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class SelectNormalDistrito extends Component
{
    public $distritos = array();
    public $distrito_id;
    public $identificador = 0;

    protected $listeners = [
        'eventoRefreshDistrito',
    ];

    public function mount()
    {
        $this->cargarDistritos(0);
    }

    public function cargarDistritos($id)
    {
        // identificador = 0: proviene de carga inicial
        // identificador > 0: id nuevo registro, se agregó nuevo distrito
        ($id > 0) ? $this->identificador = $id : $this->identificador = 0;
        // $this->distritos = Distrito::orderBy('id', 'desc')->pluck('nombre', 'id')->dd();
        // $this->distritos = Distrito::orderBy('id', 'desc')->pluck('nombre', 'id');
        $this->distritos = Distrito::orderBy('id', 'desc')->get();
    }

    public function updatedDistritoId($id)
    {
        $this->emitUp('eventoLimpiarProvinciaComuna');
        $this->emitTo('select-normal-provincia', 'eventoResetProvincias');
        $this->emitTo('select-normal-comuna', 'eventoResetComunas');
        if($id != ""){
            $this->emitTo('select-normal-provincia', 'eventoCargarProvincias', $id);
            $this->emitTo('select-normal-provincia', 'eventoActivarNuevaProvincia');
        }
        $this->emitUp('eventoCargarDistritoEnForm', $id);
    }

    public function setearFormModal()
    {
        $parametros_modal = array(
            'id' => 1,
            'titulo' => 'Nueva Región',
            'provincia' => '',
            'comuna' => '',
        );        
        $this->emitTo('modal-nuevo-registro', 'datosModal', $parametros_modal);
    }

    public function eventoRefreshDistrito($id)
    {
        $this->cargarDistritos($id);
    }

    public function render()
    {
        return view('livewire.select-normal-distrito');
    }
}
