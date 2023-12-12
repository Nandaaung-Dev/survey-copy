<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FormTemplate;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;


class ListFormBuilder extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(FormTemplate::query())
            ->columns([
                TextColumn::make('name'),


            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('View')
                    ->icon('heroicon-m-eye')
                    ->url(fn (FormTemplate $record): string => route('filament.admin.pages.show-form-builder', ['record' => $record])),
                Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (FormTemplate $record): string => route('filament.admin.pages.edit-form-builder', ['record' => $record])),
                DeleteAction::make('delete')

            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function createFormTemplate()
    {
        return redirect()->route('filament.admin.pages.form-builder');
    }
    
    public function render()
    {
        return view('livewire.list-form-builder');
    }
}
