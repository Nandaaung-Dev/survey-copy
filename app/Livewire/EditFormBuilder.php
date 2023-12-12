<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\FormTemplate;

class EditFormBuilder extends Component
{
    public  $record_id;
    public FormTemplate $form_template;
    public $content;
    public $name;
    public $regions;
    public $townships;
    public $quarters;
    public $nrcs;
    public function mount()
    {
        $this->record_id = request()->query('record');
        $this->form_template = FormTemplate::find($this->record_id);
        $this->name = $this->form_template->name;

        // $this->regions = Region::get()->pluck('name', 'id')->toArray();
        // $this->townships = Township::get()->pluck('name', 'id')->toArray();
        // $this->quarters = Quarter::get()->pluck('name', 'id')->toArray();
        // $this->nrcs = NRC::get()->pluck('name_en', 'id')->toArray();

    }
    #[On('update')]
    public function update($content)
    {
        $this->content = json_decode($content);

        $form_template =  FormTemplate::find($this->record_id);
        $form_template->name = $this->name;
        $form_template->content = $this->content;

        $form_template->update();
        return redirect()->route('filament.admin.pages.list-form-builder');
    }
    
    public function render()
    {
        return view('livewire.edit-form-builder');
    }
}
