<?php

namespace App\Livewire;

use App\Models\Form;
use Livewire\Component;
use Livewire\Attributes\On;

class EditForm extends Component
{
    public $content;
    public  $record_id;
    public Form $form;
    public function mount()
    {
        $this->record_id = request()->query('record');
        $this->form = Form::find($this->record_id);
    }

    #[On('update')]
    public function update($message)
    {
        $this->content = json_decode($message);

        Form::find($this->record_id)->update([
            'form' => $this->content,
        ]);
        return redirect()->route('filament.admin.pages.list-form');
    }

    public function render()
    {
        return view('livewire.edit-form');
    }
}
