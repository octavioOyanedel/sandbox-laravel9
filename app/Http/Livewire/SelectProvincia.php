<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectProvincia extends Component
{
    public $distrito;
    public $key;

    public function render()
    {
        return view('livewire.select-provincia');
    }
  
}
