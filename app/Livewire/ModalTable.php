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
        Rgeocode::destroy($id);
        $this->dispatch('data-deleted', $id);
    }
    
 
    public function render()
    {
        return view('livewire.modal-table');
    }
}
