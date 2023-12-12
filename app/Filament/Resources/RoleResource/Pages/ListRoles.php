<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Permission\PagePermission;
use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{
    use PagePermission;

    protected static ?string $permission = 'role-list';

    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        if (authUser()->canAccess('role-create')) {
            return [
                Actions\CreateAction::make(),
            ];
        }

        return [];
    }
}
