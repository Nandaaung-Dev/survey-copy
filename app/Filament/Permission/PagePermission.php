<?php

namespace App\Filament\Permission;

trait PagePermission
{
    public static function authorizeResourceAccess(): void
    {
        if (isset(static::$permission)) {
            if (! authUser()->canAccess(static::$permission)) {
                redirect()->route('filament.admin.pages.forbidden');
            }
        }
    }
}
