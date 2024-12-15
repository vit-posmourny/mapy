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

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('/post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

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
