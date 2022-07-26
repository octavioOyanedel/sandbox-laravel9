<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class SelectNormalDistrito extends Component
{
    public $distrito_id;
    public $option_inicial = 0;
    public $arreglo_filtrado = array();

    protected $listeners = [
        'eventoRefreshDistrito',
    ];

    public function mount()
    {
        $this->cargarDistritos(0);
    }

    public function cargarDistritos($id)
    {
        $eliminar = array('created_at', 'updated_at'); // campos a filtrar
        ($id > 0) ? $this->option_inicial = $id : $this->option_inicial = 0;
        if($id === 0){
            $distritos = Distrito::orderBy('nombre', 'asc')->get()->toarray();
            $this->arreglo_filtrado = filtrarArregloParaSelect($distritos, $eliminar);
        // caso contrario, todos los registros excepto último
        }else{
            $distritos = Distrito::where('id','<>', $id)->orderBy('nombre', 'asc')->get()->toarray();
            $ultimo = Distrito::findOrFail($id)->toarray();
            array_unshift($distritos, $ultimo);
            $this->arreglo_filtrado = filtrarArregloParaSelect($distritos, $eliminar);
            $this->emitTo('select-normal-provincia', 'eventoActivarNuevaProvincia');
            $this->emitUp('eventoCargarDistritoEnForm', $id);
        }
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
            'distrito' => '',
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
