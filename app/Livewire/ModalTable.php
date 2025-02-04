<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;
use App\Models\Rgeocode;

class ModalTable extends Component
{
    #[Modelable] // musí zde být
    public $data;


    public function delete($id)
    {
        Rgeocode::destroy($id);
        session()->flash('success', 'true');
    }
    
 
    public function render()
    {
        return view('livewire.modal-table');
    }
}
