<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;
use App\Models\Provincia;

class SelectNormalProvincia extends Component
{
    // atributos select
    public $provincia;
    public $arreglo = array();
    public $posicion_default_option = true; // true = up, false = down
    public $boton_agregar = false;
    public $distrito; // id distrito
    
    protected $listeners = [
        'eventoActivarModuloProvincia',
        'eventoResetProvincia'
    ];

    // 1. activación módulo provincias, poblar select provincias con id de distrito y activar botón agregar
    public function eventoActivarModuloProvincia($id)
    {
        $this->poblarSelect($id, $via = 0);
    }

    // 2. poblar select 
    public function poblarSelect($id, $via)
    {
        $this->distrito = $id;
        $eliminar = array('distrito_id', 'created_at', 'updated_at');
        // si $via = 0 -> carga normal desde distrito, sino -> post agregar nuevo
        if($via === 0){
            $this->boton_agregar = true;
            $provincias = Provincia::where('distrito_id', $id)->orderBy('nombre', 'asc')->get()->toarray();
            $this->posicion_default_option = true;
            $this->arreglo = filtrarArregloParaSelect($provincias, $eliminar);
        }else{
            $provincias = Provincia::where('id', '<>', $id)->orderBy('nombre', 'asc')->get()->toarray();
            $ultimo = Provincia::findOrFail($id)->toarray();
            array_unshift($provincias, $ultimo);
            $this->posicion_default_option = false;
            $this->arreglo = filtrarArregloParaSelect($provincias, $eliminar);
            $this->activarModuloComuna($id);
            $this->enviarRegistroHaciaForm($id);            
        }
    }

    // 3. comportamiento tras seleccionar registro
    public function updatedProvincia($id)
    {
        // solo si se selecciona elemeto no vacío (default option)
        if($id != ""){
            // bloque eventos a siguiente select
            $this->activarModuloComuna($id);
        }
        // bloque eventos reset hacia los siguientes selects
        $this->resetSelectsDependientes();
        //bloque eventos hacia form
        $this->enviarRegistroHaciaForm($id);
    }

    // 4. envío de parametros para completar ventane modal
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

    // 5. carga de distritos, más ultimo almacenado
    public function eventoCargarRegistro($id)
    {
        $this->poblarSelect($id, 1);
    }

    public function activarModuloComuna($id)
    {
        $this->emitTo('select-normal-comuna', 'eventoActivarModuloComuna', $id);
    }

    public function resetSelectsDependientes()
    {
        $this->emitTo('select-normal-comuna', 'eventoResetComuna');
    }

    public function enviarRegistroHaciaForm($id)
    {
        $this->emitUp('eventoEnviarProvinciaHaciaForm', $id);
    }

    public function eventoResetProvincia()
    {
        $this->reset('provincia');
    }

    public function render()
    {
        return view('livewire.select-normal-provincia');
    }
}
