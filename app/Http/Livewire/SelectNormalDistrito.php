<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class SelectNormalDistrito extends Component
{
    // atributos select
    public $distrito;
    public $arreglo = array();
    public $posicion_default_option = true; // true = up, false = down

    protected $listeners = [
        'eventoCargarRegistro'
    ];

    // carga de registros al montar componente
    public function mount()
    {
        $this->poblarSelect();
    }

    // 1. poblar select 
    public function poblarSelect($distrito_id = 0, $post_guardar = false)
    {
        $eliminar = array('created_at', 'updated_at');
        // evita problema de no carga de ultimo si hay un update previo
        $this->resetAntesDePoblar();
        // si $post_guardar === false y $distrito_id === 0 -> mount, sino -> post agregar nuevo
        if(!$post_guardar and $distrito_id === 0){
            $distritos = Distrito::orderBy('nombre', 'asc')->get()->toarray();
            $this->posicion_default_option = true;
            $this->arreglo = filtrarArregloParaSelect($distritos, $eliminar);
        }else{
            $distritos = Distrito::where('id', '<>', $distrito_id)->orderBy('nombre', 'asc')->get()->toarray();
            $ultimo = Distrito::findOrFail($distrito_id)->toarray();
            array_unshift($distritos, $ultimo);
            $this->posicion_default_option = false;
            $this->arreglo = filtrarArregloParaSelect($distritos, $eliminar);
            $this->activarModuloProvincia($distrito_id);
            $this->enviarRegistroHaciaForm($distrito_id);
        }
    }

    // 2. comportamiento tras seleccionar registro
    public function updatedDistrito($id)
    {
        // solo si se selecciona elemeto no vacío (default option)
        if($id != ""){
            // bloque eventos a siguiente select
            $this->activarModuloProvincia($id);
            //bloque eventos hacia form
            $this->enviarRegistroHaciaForm($id);
        }else{
            // bloque eventos reset hacia los siguientes selects
            $this->resetSelectsDependientes();            
        }
    }

    // 3. envío de parametros para completar ventane modal
    public function enviarDatosHaciaModal()
    {
        $parametros = array(
            'select' => 'distrito',
            'titulo' => 'Nueva Región',
            'distrito' => '',            
            'provincia' => '',            
            'comuna' => '',            
        );
        $this->emitTo('modal-nuevo-registro', 'eventoParametrosModal', $parametros);
    }

    // 4. carga de distritos, más ultimo almacenado
    public function eventoCargarRegistro($id)
    {
        $this->poblarSelect($id, true);
    }

    public function activarModuloProvincia($id)
    {
        $this->emitTo('select-normal-provincia', 'eventoActivarModuloProvincia', $id);
    }

    public function resetSelectsDependientes()
    {
        $this->emitTo('select-normal-provincia', 'eventoResetProvincia');
        $this->emitTo('select-normal-comuna', 'eventoResetComuna');
    }

    public function enviarRegistroHaciaForm($id)
    {
        $this->emitUp('eventoEnviarDistritoHaciaForm', $id);
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
