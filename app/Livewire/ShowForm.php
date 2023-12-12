<?php

namespace App\Livewire;

use App\Models\Form;
use Livewire\Component;

class ShowForm extends Component
{
    public  $record_id;
    public Form $form;
    public function mount()
    {
        $this->record_id = request()->query('record');
        $this->form = Form::find($this->record_id);
    }
    public function render()
    {
        return view('livewire.show-form');
    }
}
