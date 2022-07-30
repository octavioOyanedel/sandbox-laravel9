<?php

namespace App\Http\Livewire;

use App\Models\Comuna;
use Livewire\Component;
use App\Models\Provincia;

class SelectNormalComuna extends Component
{
    public $comuna; 
    public $arreglo = array();
    public $posicion_default_option = true; // true = up, false = down
    public $boton_agregar = false;
    public $eliminar = array('distrito_id', 'provincia_id', 'created_at', 'updated_at');
    public $distrito;
    public $provincia;

    protected $listeners = [
        'eventoActivarModuloComuna',
        'eventoResetComuna',
        'eventoCargaNuevaComuna'
    ];

    public function eventoActivarModuloComuna($id)
    {
        $this->cargaNormal($id);
        $this->obtenerDistritoComuna($id);
    }

    // 1. carga inicial tras seleccion de select padre
    public function cargaNormal($id)
    {   
        $this->eventoResetComuna();
        $this->boton_agregar = true;    
        $comunas = Comuna::where('provincia_id', $id)->orderBy('nombre', 'asc')->get()->toarray();
        $this->posicion_default_option = true;
        $this->arreglo = filtrarArregloParaSelect($comunas, $this->eliminar);
    }

    // 2. seleccion de registro
    public function updatedComuna($id)
    {
        $this->enviarRegistroHaciaForm($id);
    }

    // 3. recibir datos desde select para enviar a modal
    public function enviarDatosHaciaModal()
    {
        $parametros = array(
            'select' => 'comuna',
            'titulo' => 'Nueva Comuna',
            'distrito' => $this->distrito,            
            'provincia' => $this->provincia,            
            'comuna' => '',            
        );
        $this->emitTo('modal-nuevo-registro', 'eventoParametrosModal', $parametros);       
    }

    // 4. carga post nuevo registro
    public function eventoCargaNuevaComuna($id)
    {   
        $this->eventoResetComuna(); 
        $this->boton_agregar = true;
        $distrito = Comuna::findOrFail($id)->distrito_id;
        $provincia = Comuna::findOrFail($id)->provincia_id;
        $comunas = Comuna::where('distrito_id', $distrito)->where('provincia_id', $provincia)->where('id', '<>', $id)->orderBy('nombre', 'asc')->get()->toarray();
        $ultimo = Comuna::findOrFail($id)->toarray();
        array_unshift($comunas, $ultimo);
        $this->posicion_default_option = false;
        $this->arreglo = filtrarArregloParaSelect($comunas, $this->eliminar);
        $this->enviarRegistroHaciaForm($id);
    }

    // eventos

    public function obtenerDistritoComuna($id)
    {
        $this->provincia = $id;
        $this->distrito = Provincia::findOrFail($id)->distrito_id;
    }

    public function eventoResetComuna()
    {
        $this->reset();
    }


    public function enviarRegistroHaciaForm($id)
    {
        $this->emitUp('eventoEnviarComunaHaciaForm', $id);
    }

    public function render()
    {
        return view('livewire.select-normal-comuna');
    }
}
