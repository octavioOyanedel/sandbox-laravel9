<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;
use App\Models\Provincia;

class SelectNormalProvincia extends Component
{
    public $provincia; 
    public $arreglo = array();
    public $posicion_default_option = true; // true = up, false = down
    public $boton_agregar = false;
    public $eliminar = array('distrito_id', 'created_at', 'updated_at');
    public $distrito; 

    protected $listeners = [
        'eventoActivarModuloProvincia',
        'eventoResetProvincia',
        'eventoCargaNuevaProvincia'
    ];

    public function eventoActivarModuloProvincia($id)
    {
        $this->cargaNormal($id);
        $this->obtenerDistrito($id);
    }

    // 1. carga inicial tras seleccion de select padre
    public function cargaNormal($id)
    {   
        $this->boton_agregar = true;
        $provincias = Provincia::where('distrito_id', $id)->orderBy('nombre', 'asc')->get()->toarray();
        $this->posicion_default_option = true;
        $this->arreglo = filtrarArregloParaSelect($provincias, $this->eliminar);
    }

    // 2. seleccion de registro
    public function updatedProvincia($id)
    {
        $this->resetSelectsDependientes();        
        if($id != ""){          
            $this->activarModuloComuna($id);
            $this->enviarRegistroHaciaForm($id);
        }
    }

    // 3. recibir datos desde select para enviar a modal
    public function enviarDatosHaciaModal()
    {       
        $parametros = array(
            'select' => 'provincia',
            'titulo' => 'Nueva Provincia',
            'distrito' => $this->distrito,            
            'provincia' => '',
            'comuna' => '',            
        );
        $this->emitTo('modal-nuevo-registro', 'eventoParametrosModal', $parametros);       
    }

    // 4. carga post nuevo registro
    public function eventoCargaNuevaProvincia($id)
    {   
        $this->eventoResetProvincia(); 
        $this->boton_agregar = true;
        $distrito = Provincia::findOrFail($id)->distrito_id;
        $provincias = Provincia::where('distrito_id', $distrito)->where('id', '<>', $id)->orderBy('nombre', 'asc')->get()->toarray();
        $ultimo = Provincia::findOrFail($id)->toarray();
        array_unshift($provincias, $ultimo);
        $this->posicion_default_option = false;
        $this->arreglo = filtrarArregloParaSelect($provincias, $this->eliminar);
        $this->activarModuloComuna($id);
        $this->enviarRegistroHaciaForm($id);
    }

    // eventos

    public function obtenerDistrito($id)
    {
        $this->distrito = $id;
    }

    public function eventoResetProvincia()
    {
        $this->reset();
    }

    public function resetSelectsDependientes()
    {
        $this->emitTo('select-normal-comuna', 'eventoResetComuna');
    }

    public function enviarRegistroHaciaForm($id)
    {
        $this->emitUp('eventoEnviarProvinciaHaciaForm', $id);
    }

    public function activarModuloComuna($id)
    {
        $this->emitTo('select-normal-comuna', 'eventoActivarModuloComuna', $id);
    }

    public function render()
    {
        return view('livewire.select-normal-provincia');
    }
}
