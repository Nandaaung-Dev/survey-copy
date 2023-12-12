<?php

namespace App\Filament\Resources;

use App\Filament\Permission\NavigationPermission;
use App\Filament\Resources\RoleResource\Pages;
use App\Models\Role;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\CheckboxList;

class RoleResource extends Resource
{
    use NavigationPermission;

    protected static ?string $model = Role::class;

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $permission = 'role-list';

    public static function form(Form $form): Form
    {
        $permissions = [];
        $configPermissions = collect(config('permissions'));
        foreach ($configPermissions as $label => $group) {
            $permissions[] = CheckboxList::make('permissions')
                ->options(collect($group)->pluck('en', 'slug')->toArray())
                ->label($label)
                ->default([])
                ->bulkToggleable()
                ->columns(2);
        }

        $selectedAllPermissions = $configPermissions
            ->collapse()
            ->pluck('slug')
            ->toArray();

        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->inlineLabel()
                            ->unique(ignorable: fn ($record) => $record),
                        TextInput::make('level')
                            ->required()
                            ->integer()
                            ->inlineLabel()
                            ->unique(ignorable: fn ($record) => $record),
                    ]),
                Section::make()
                    ->schema([
                        Toggle::make('select_all')
                            ->reactive()
                            ->afterStateUpdated(fn ($state, $set) => $state ? $set('permissions', $selectedAllPermissions) : $set('permissions', [])),
                        ...$permissions
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No.')->rowIndex(),
                TextColumn::make('name'),
                TextColumn::make('level'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn () => authUser()->canAccess('role-edit')),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
