<?php

namespace App\Http\Livewire;

use App\Rules\Nombre;
use Livewire\Component;
use App\Models\Distrito;
use App\Models\Provincia;

class ModalNuevoRegistro extends Component
{
    // atributos modal
    public $nombre;
    public $titulo;
    public $select;
    public $distrito;
    public $nombre_distrito;

    protected $listeners = ['eventoParametrosModal'];

    // 1. parámetros necesarios para despliegue de ventana modal
    public function eventoParametrosModal($parametros)
    {
        $this->limpiarModal();
        $this->titulo = $parametros['titulo'];
        $this->select = $parametros['select'];
        $this->distrito = $parametros['distrito'];
        // $this->$provincia = $parametros['provincia'];
        // $this->$comuna = $parametros['comuna'];
        if($parametros['select'] === 'provincia'){
            $this->nombre_distrito = Distrito::findOrFail($parametros['distrito'])->nombre;
        }
    }

    // 2. guardar nuevo registro
    public function guardarRegistro()
    {
        switch($this->select)
        {
            case 'distrito':
                $this->validate([
                    'nombre' => ['required', new Nombre, 'unique:distritos,nombre'],
                ]);
                $distrito = Distrito::create([
                    'nombre' => $this->nombre
                ]);
                $nombre = $distrito->nombre;
                $mensaje = 'Región '.$nombre.' añadida correctamente.';
                $this->cargarRegistroGuardado($distrito->id, $this->select);
                break;
            case 'provincia':
                /*$this->validate([
                    'nombre' => ['required', new Nombre, 'unique:provincias,nombre'],
                ]);
                $provincia = Provincia::create([
                    'nombre' => $this->nombre,
                    'distrito_id' => $this->distrito
                ]);
                $nombre = $provincia->nombre;
                $mensaje = 'Provincia '.$nombre.' añadida correctamente.';
                $this->cargarRegistroGuardado($this->distrito, $provincia->id, 0, $this->select);*/
                break;                
        }
        $this->procesoFinalizado($mensaje);
    }
    
    // 3. cargar en select último registro almacenado 
    public function cargarRegistroGuardado($id, $select)
    {
        $this->emitTo('select-normal-'.$select, 'eventoCargarRegistro', $id);
    }

    public function procesoFinalizado($mensaje)
    {
        $this->emit('eventoCerrarModal');
        $this->emit('eventoMensajeFinal', $mensaje);   
    }

    public function limpiarModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    } 

    public function render()
    {
        return view('livewire.modal-nuevo-registro');
    }   
}
