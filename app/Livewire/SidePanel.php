<?php

namespace App\Livewire;

use App\Models\Place;
use Illuminate\Http\Request;
use Livewire\Component;

class SidePanel extends Component
{

    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function store()
    {
       
    }

    public function render()
    {
        return view('livewire.side-panel');
    }
}
