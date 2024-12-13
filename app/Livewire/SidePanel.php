<?php
namespace App\Livewire;

use App\Models\Place;
use Livewire\Component;

class SidePanel extends Component
{
    
    public $latitude = null;
    public $longitude = null;
    public $elevation = null;


    public function store()
    {
        Place::create([

            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'elevation' => $this->elevation,
        ]);
    }


    public function render()
    {
        return view('livewire.side-panel');
    }
}
