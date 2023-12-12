<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class EditFormBuilder extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-form-builder';
    
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
