<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Permission\PagePermission;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    use PagePermission;

    protected static ?string $permission = 'user-edit';

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        if (authUser()->canAccess('user-delete')) {
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
