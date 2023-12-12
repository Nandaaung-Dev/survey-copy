<?php

namespace App\Livewire;

use App\Models\Form;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\FormTemplate;

class ShowFormBuilder extends Component
{

    public  $record_id;
    public $content;
    public FormTemplate $form_template;
    public function mount()
    {
        $this->record_id = request()->query('record');
        $this->form_template = FormTemplate::find($this->record_id);
    }

    #[On('create')]
    public function create($message)
    {
        $this->content = json_decode($message);

        Form::create([
            'form_template_id' => $this->record_id,
            'form' => @json_encode($this->content)
        ]);
        return redirect()->route('filament.admin.pages.list-form-builder');
    }

    public function render()
    {
        return view('livewire.show-form-builder');
    }
}
