<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Components\AddressForm;
use App\Filament\Resources\BranchResource\Pages;
use App\Models\Branch;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->inlineLabel()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->inlineLabel()
                            ->maxLength(255),
                        Forms\Components\Select::make('department_id')
                            ->options(Department::all()->pluck('name', 'id'))
                            ->label('Department')
                            ->placeholder('Please choose department')
                            ->searchable()
                            ->required()
                            ->inlineLabel(),
                        Repeater::make('addresses')
                            ->relationship('addresses')
                            ->columns(3)
                            ->label('Address')
                            ->schema([
                                AddressForm::make('addresses')
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->rowIndex()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}



