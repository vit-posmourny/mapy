<?php

namespace App\Livewire;

use App\Models\Rgeocode;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class RgeocodePanel extends Component
{

    public $label = '';
    public $location = '';
    public $name = '';
    public $latitude = null;
    public $longitude = null;
    public $regional_address = '';
    public $regional_street = '';
    public $regional_municipality_part_1 = '';
    public $regional_municipality_part_2 = '';
    public $regional_municipality = '';
    public $regional_region_1 = '';
    public $regional_region_2 = '';
    public $regional_country = '';
    public $isoCode = '';
    public $zip = '';

    public $data = [];


    protected $listeners = [
        'values-updated' => 'handleUserUpdate',
    ];


    public function handleUserUpdate( $label, $location, $name, $lat, $lon, $regional_address, 
        $regional_street, $regional_municipality_part_1, $regional_municipality_part_2, 
        $regional_municipality, $regional_region_1, $regional_region_2, $regional_country, $isoCode, $zip )
    {
        $this->latitude = $lat;
        $this->longitude = $lon;
        $this->regional_address = $regional_address;
        $this->regional_street = $regional_street;
        $this->regional_municipality_part_1 = $regional_municipality_part_1;
        $this->regional_municipality_part_2 = $regional_municipality_part_2;
        $this->regional_municipality = $regional_municipality;
        $this->regional_region_1 = $regional_region_1;
        $this->regional_region_2 = $regional_region_2;
        $this->regional_country = $regional_country;
        $this->isoCode = $isoCode;
        $this->label = $label;
        $this->location = $location;
        $this->name = $name;
        $this->zip = $zip;
    }   
    

    public function store()
    {
        $validated = $this->validate([ 
            
            'label' => 'string|max:255',
            'location' => 'string|max:255',
            'name' => 'string|max:255',
            'latitude' => 'numeric|max:360',
            'longitude' => 'numeric|max:360',
            'regional_address' => 'string|max:255',
            'regional_street' => 'string|max:255',
            'regional_municipality_part_1' => 'string|max:255',
            'regional_municipality_part_2' => 'string|max:255',
            'regional_municipality' => 'string|max:255',
            'regional_region_1' => 'string|max:255',
            'regional_region_2' => 'string|max:255',
            'regional_country' => 'string|max:255',
            'isoCode' => 'string|max:255',
            'zip' => 'string|max:6',
        ],[
            'zip' => 'Pole PSČ, nesmí mít více než 6 znaků.'
        ]);

        //znovu nastaví hodnoty všech props.komponenty do init.stavu
        $this->reset();

        $validated += ['user_id' => auth()->id()];

        Rgeocode::create($validated);

        session()->flash('success', 'true');
    }


    public function readData(): void
    {
        $this->reset('data');

        $records = DB::select('select * from rgeocodes where user_id = ?', [auth()->id()]);
        
        foreach ($records as $record) {

            $this->data[] = [
                'label' => $record->label,
                'location' => $record->location,
                'name' => $record->name,
                'zip' => $record->zip,
                'isoCode' => $record->isoCode,
                'latitude' => $record->latitude,
                'longitude' => $record->longitude,
            ];
        }
    }


    public function render()
    {
        return view('livewire.rgeocode-panel');
    }
}
