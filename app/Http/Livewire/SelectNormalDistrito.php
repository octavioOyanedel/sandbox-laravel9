<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Distrito;

class SelectNormalDistrito extends Component
{
    public $distritos;
    public $distrito_id;

    public function mount()
    {
        $this->distritos = Distrito::all()->pluck('nombre', 'id');
    }

    public function updatedDistritoId($id)
    {
        $this->emitUp('eDistritoHaciaForm', $id);
        $this->emit('eDistritoHaciaProvincia', $id);
    }

    public function render()
    {
        return view('livewire.select-normal-distrito');
    }
}
