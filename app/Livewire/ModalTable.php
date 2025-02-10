<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rgeocode;
use Livewire\Attributes\Modelable;

class ModalTable extends Component
{
    #[Modelable] // musí zde být
    public $data;


    public function delete($id)
    {
        $destroy_success =  Rgeocode::destroy($id);

        $this->dispatch('data-deleted', id: $id, destroy_success: $destroy_success);
    }
    
 
    public function render()
    {
        return view('livewire.modal-table');
    }
}