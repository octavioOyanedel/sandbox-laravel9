<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class TomSelect extends Component
{
    public $distritos;

    protected $listeners = ['eventoSelectDistrito'];

    public function mount()
    {
        $this->distritos = Distrito::all();
    }

    public function render()
    {
        return view('livewire.tom-select');
    }
    public function eventoSelectDistrito($id)
    {
        $this->emit('allaVaElId', $id);
    }
}
