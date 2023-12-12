<?php

namespace App\Filament\Resources;

use App\Filament\Permission\NavigationPermission;
use App\Filament\Resources\UserResource\Pages;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    use NavigationPermission;

    protected static ?string $permission = 'user-list';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->inlineLabel(),
                        Forms\Components\Select::make('role_id')
                            ->required()
                            ->searchable()
                            ->placeholder('Please Choose Role')
                            // ->options(collect(config('role'))->pluck('name', 'value')->toArray())
                            ->options(Role::all()->pluck('name', 'id'))
                            ->inlineLabel(),
                        Forms\Components\Select::make('department_id')
                            ->label('Good')
                            ->required()
                            ->searchable()
                            ->placeholder('Please Choose Department')
                            ->options(Department::query()->pluck('name', 'id'))
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255)
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->maxLength(255)
                            ->confirmed()
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->inlineLabel(),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->maxLength(255)
                            ->inlineLabel()
                            ->required(fn (string $operation): bool => $operation === 'create'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn () => authUser()->canAccess('user-edit')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
