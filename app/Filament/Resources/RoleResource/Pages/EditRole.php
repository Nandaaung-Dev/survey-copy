<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Permission\PagePermission;
use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    use PagePermission;

    protected static ?string $permission = 'role-edit';

    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        if (authUser()->canAccess('role-delete')) {
            return [
                Actions\DeleteAction::make(),
            ];
        }

        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
