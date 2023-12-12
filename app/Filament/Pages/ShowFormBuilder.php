<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ShowFormBuilder extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.show-form-builder';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
