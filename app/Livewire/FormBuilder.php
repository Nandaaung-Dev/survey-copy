<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Form;
use Livewire\Attributes\On;
use App\Models\FormTemplate;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class FormBuilder extends Component implements HasForms
{

    use InteractsWithForms;

    public $content;
    public $regions;
    public $townships;
    public $quarters;
    public $nrcs;

    #[On('create')]
    public function create($message)
    {
        $this->content = json_decode($message);

        FormTemplate::create([
            'name' => $this->form->getState()['name'],
            'content' => $this->content
        ]);

        return redirect()->route('filament.admin.pages.list-form-builder');
    }

    public ?array $data = [];
    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                // ...
            ])
            ->statePath('data');
    }
    public function render()
    {
        return view('livewire.form-builder');
    }
}
