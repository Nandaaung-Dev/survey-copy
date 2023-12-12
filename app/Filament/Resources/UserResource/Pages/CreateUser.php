<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Permission\PagePermission;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use PagePermission;

    protected static ?string $permission = 'user-create';

    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
