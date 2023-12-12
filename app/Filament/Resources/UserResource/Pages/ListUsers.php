<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Permission\PagePermission;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    use PagePermission;

    protected static ?string $permission = 'user-list';

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        if (authUser()->canAccess('user-create')) {
            return [
                Actions\CreateAction::make(),
            ];
        }

        return [];
    }
}
