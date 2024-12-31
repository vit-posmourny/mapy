<?php
namespace App\Livewire;

use App\Models\Place;
use Livewire\Component;

class SidePanel extends Component
{
    public $latitude = null;
    public $longitude = null;
    public $elevation = null;

    protected $listeners = [
        'values-updated' => 'handleUserUpdate',
    ];


    public function handleUserUpdate($latitude, $longitude, $elevation)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->elevation = $elevation;
    }   
   

    public function store()
    {
        $validated = $this->validate([ 
            
            'latitude' => 'required|numeric|max:360',
            'longitude' => 'required|numeric|max:360',
            'elevation' => 'required|numeric|max:9999',
        ],[
            'latitude.numeric' => "Hodnota v poli musí být číselná.",
            'longitude.numeric' => "Hodnota v poli musí být číselná.",
            'elevation.numeric' => "Hodnota v poli musí být číselná.",
            'latitude.required' => "Pole nesmí zůstat prázdně.",
            'longitude.required' => "Pole nesmí zůstat prázdně.",
            'elevation.required' => "Pole nesmí zůstat prázdně.",
        ]);

        //znovu nastaví hodnoty všech props.komponenty do init.stavu tj.null
        $this->reset();

        Place::create($validated);

        session()->flash('success', 'true');
    }

    public function render()
    {
        return view('livewire.side-panel');
    }
}
