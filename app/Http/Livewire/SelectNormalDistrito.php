<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class SelectNormalDistrito extends Component
{
    public $distrito;
    public $arreglo = array();
    public $posicion_default_option = true; // true = up, false = down
    public $eliminar = array('created_at', 'updated_at');

    protected $listeners = [
        'eventoCargaNuevoDistrito'
    ];

    public function mount()
    {
        $this->cargaNormal();
    }

    // 1. carga inicial desde controlador
    public function cargaNormal()
    {       
        $distritos = Distrito::orderBy('nombre', 'asc')->get()->toarray();
        $this->posicion_default_option = true;
        $this->arreglo = filtrarArregloParaSelect($distritos, $this->eliminar);
    }

    // 2. seleccion de registro
    public function updatedDistrito($id)
    {
        $this->resetSelectsDependientes();
        if($id != ""){
            $this->activarModuloProvincia($id);
            $this->enviarRegistroHaciaForm($id);
        }
    }

    // 3. recibir datos desde select para enviar a modal
    public function enviarDatosHaciaModal()
    {
        $parametros = array(
            'select' => 'distrito',
            'titulo' => 'Nueva Región',
            'distrito' => $this->distrito,            
            'provincia' => '',            
            'comuna' => '',            
        );
        $this->emitTo('modal-nuevo-registro', 'eventoParametrosModal', $parametros);       
    }

    // 4. carga post nuevo registro
    public function eventoCargaNuevoDistrito($id)
    {   
        $this->resetAntesDePoblar(); 
        $distritos = Distrito::where('id', '<>', $id)->orderBy('nombre', 'asc')->get()->toarray();
        $ultimo = Distrito::findOrFail($id)->toarray();
        array_unshift($distritos, $ultimo);
        $this->posicion_default_option = false;
        $this->arreglo = filtrarArregloParaSelect($distritos, $this->eliminar);
        $this->activarModuloProvincia($id);
        $this->enviarRegistroHaciaForm($id);
    }

    // eventos

    public function resetSelectsDependientes()
    {
        $this->emitTo('select-normal-provincia', 'eventoResetProvincia');
        $this->emitTo('select-normal-comuna', 'eventoResetComuna');
        $this->emitUp('eventoResetDisProCom');

    }

    public function enviarRegistroHaciaForm($id)
    {
        $this->emitUp('eventoEnviarDistritoHaciaForm', $id);
    }

    public function activarModuloProvincia($id)
    {
        $this->emitTo('select-normal-provincia', 'eventoActivarModuloProvincia', $id);
    }

    public function resetAntesDePoblar()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.select-normal-distrito');
    }
}
