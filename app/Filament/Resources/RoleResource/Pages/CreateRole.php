<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Permission\PagePermission;
use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    use PagePermission;

    protected static ?string $permission = 'role-create';

    protected static string $resource = RoleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
