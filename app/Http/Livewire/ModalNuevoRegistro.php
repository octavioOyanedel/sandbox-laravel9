<?php

namespace App\Http\Livewire;

use App\Rules\Nombre;
use App\Models\Comuna;
use Livewire\Component;
use App\Models\Distrito;
use App\Models\Provincia;

class ModalNuevoRegistro extends Component
{
    public $select;
    public $titulo;
    public $distrito;
    public $provincia;
    public $comuna;
    public $nombre;

    protected $listeners = [
        'eventoParametrosModal'
    ];

    // 1. parámetros necesarios para despliegue de ventana modal
    public function eventoParametrosModal($parametros)
    {
        $this->limpiarModal();
        $this->select = $parametros['select'];
        $this->titulo = $parametros['titulo'];
        $this->distrito = $parametros['distrito'];
        $this->provincia = $parametros['provincia'];
        $this->comuna = $parametros['comuna'];
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
                $this->cargarDistritos($distrito->id);
                break;
            case 'provincia':
                $this->validate([
                    'nombre' => ['required', new Nombre, 'unique:provincias,nombre'],
                ]);
                $provincia = Provincia::create([
                    'nombre' => $this->nombre,
                    'distrito_id' => $this->distrito
                ]);
                $nombre = $provincia->nombre;
                $mensaje = 'Provincia '.$nombre.' añadida correctamente.';
                $this->cargarProvincias($provincia->id);
                break;
            case 'comuna':
                $this->validate([
                    'nombre' => ['required', new Nombre, 'unique:comunas,nombre'],
                ]);
                $comuna = Comuna::create([
                    'nombre' => $this->nombre,
                    'distrito_id' => $this->distrito,
                    'provincia_id' => $this->provincia
                ]);
                $nombre = $comuna->nombre;
                $mensaje = 'Comuna '.$nombre.' añadida correctamente.';
                $this->cargarComunas($comuna->id);
                break;                
        }
        $this->procesoFinalizado($mensaje);
    }

    // eventos

    public function cargarDistritos($id)
    {
        $this->emitTo('select-normal-distrito', 'eventoCargaNuevoDistrito', $id);  
    }

    public function cargarProvincias($id)
    {
        $this->emitTo('select-normal-provincia', 'eventoCargaNuevaProvincia', $id);  
    }

    public function cargarComunas($id)
    {
        $this->emitTo('select-normal-comuna', 'eventoCargaNuevaComuna', $id);  
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
