<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Place;

class SidePanel extends Component
{

    public function store()
    {
        dd('jsem v store');
    }

    public function render()
    {
        return view('map');
    }
}
