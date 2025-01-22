<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class ModalTable extends Component
{
    /*  If you want to enforce validation on the variable being passed, use 
       the $rules or $casts property in the child Livewire component class:

        protected $rules = [
            'label' => 'required|string|max:255',
        ]; 
    */

    #[Modelable] // musí zde být
    public $data;
    
 
    public function render()
    {
        return view('livewire.modal-table');
    }
}
