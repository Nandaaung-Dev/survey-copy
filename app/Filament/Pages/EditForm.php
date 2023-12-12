<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EditForm extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-form';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
