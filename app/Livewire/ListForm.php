<?php

namespace App\Livewire;

use App\Models\Form;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListForm extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Form::query())
            ->columns([
                TextColumn::make('id')->rowIndex(),
                TextColumn::make('form_template.name')->sortable()->label('Form Name'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('View')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Form $record): string => route('filament.admin.pages.show-form', ['record' => $record])),
                Action::make('edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (Form $record): string => route('filament.admin.pages.edit-form', ['record' => $record])),
                DeleteAction::make('delete')
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.list-form');
    }
}
