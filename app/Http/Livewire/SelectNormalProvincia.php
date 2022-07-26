<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provincia;

class SelectNormalProvincia extends Component
{
    public $distrito_id;
    public $option_inicial = 0;
    public $arreglo_filtrado = array();

    // estado inicial botón nuevo
    public $nueva_provincia = false;

    public $provincias = array();
    public $provincia_id;

    public $parametros_modal = array();

    protected $listeners = [
        'eventoCargarProvincias',
        'eventoResetProvincias',
        'eventoActivarNuevaProvincia',
        'eventoEnviarDistritoParaModal',
        'eventoRefreshProvincia'
    ];

    public function eventoCargarProvincias($id)
    {
        $eliminar = array('created_at', 'updated_at'); // campos a filtrar
        $provincias = Provincia::where('distrito_id', $id)->orderBy('nombre', 'asc')->get()->toarray();
        $this->arreglo_filtrado = filtrarArregloParaSelect($provincias, $eliminar);      
    } 

    public function cargarProvincias($id)
    {
        // dd($this->distrito_id);
        $eliminar = array('created_at', 'updated_at'); // campos a filtrar
        $this->option_inicial = 1;
        $provincias = Provincia::where('id','<>', $id)->where('distrito_id', $this->distrito_id)->orderBy('nombre', 'asc')->get()->toarray();
        $ultimo = Provincia::findOrFail($id)->toarray();
        array_unshift($provincias, $ultimo);
        $this->arreglo_filtrado = filtrarArregloParaSelect($provincias, $eliminar);
        $this->emitTo('select-normal-comuna', 'eventoActivarNuevaComuna');
        $this->emitUp('eventoCargarProvinciaEnForm', $id);
    }

    public function eventoResetProvincias()
    {
        $this->reset();
    }

    public function updatedProvinciaId($id)
    {
        $this->emitUp('eventoLimpiarComuna');
        $this->emitTo('select-normal-comuna', 'eventoResetComunas');
        if($id != ""){
            $this->emitTo('select-normal-comuna', 'eventoCargarComunas', $id);
            $this->emitTo('select-normal-comuna', 'eventoActivarNuevaComuna');
        }
        $this->emitUp('eventoCargarProvinciaEnForm', $id);
    }

    public function eventoActivarNuevaProvincia()
    {
        $this->nueva_provincia = true;
    }

    public function setearFormModal()
    {
        $parametros_modal = array(
             'id' => 2,
             'titulo' => 'Nueva Provincia',
             'distrito' => $this->distrito_id,
             'provincia' => $this->provincia_id,
             'comuna' => '',
        );
        $this->emitTo('modal-nuevo-registro', 'datosModal', $parametros_modal);
    }

    public function eventoRefreshProvincia($id)
    {
        $this->cargarProvincias($id);
    }

    public function eventoEnviarDistritoParaModal($id)
    {
        $this->distrito_id = $id;
    }

    public function render()
    {
        return view('livewire.select-normal-provincia');
    }
}
