<?php

namespace App\Livewire;

use Livewire\Component;

class SidePanel extends Component
{

    public function store()
    {
        dd('jsem ve store');
    }

    public function render()
    {
        return view('livewire.side-panel');
    }
}
