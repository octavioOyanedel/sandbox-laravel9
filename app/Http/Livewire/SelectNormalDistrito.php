<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class SelectNormalDistrito extends Component
{
    public $distritos;
    public $distrito_id;
    public $identificador = 0;
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
        ($id > 0) ? $this->identificador = $id : $this->identificador = 0;
        // carga de distritos inicial (mount)
        if($id === 0){
            $this->distritos = Distrito::orderBy('nombre', 'asc')->get();
            $arreglo = $this->distritos->toarray();
            $this->arreglo_filtrado = $this->filtrarRegistrosSelect($arreglo);
        }else{
            $this->distritos = Distrito::where('id','<>', $id)->orderBy('nombre', 'asc')->get();
            $last = Distrito::findOrFail($id)->toarray();
            $arreglo = $this->distritos->toarray(); // genera un array de arrays            
            array_unshift($arreglo, $last);
            // dd(count($arreglo));
            $this->arreglo_filtrado = $this->filtrarRegistrosSelect($arreglo);
        }
    }

    public function filtrarRegistrosSelect(&$arreglo)
    {
        foreach ($arreglo as $x => &$value) {          
            unset($value["created_at"]);
            unset($value['updated_at']);
        }
        return $arreglo;
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
