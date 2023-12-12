<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Forbidden extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.forbidden';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
