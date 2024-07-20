<?php

namespace Raakkan\ThemesManager\Filament\Pages;

use Filament\Pages\Page;

class BaseSettingPage extends Page
{
    protected static string $view = 'themes-manager::filament.pages.base-setting-page';

    protected static ?string $navigationGroup = 'Appearance';

    public function mount()
    {
    }

    public function getTitle(): string
    {
        return 'Theme Settings';
    }

    public static function getNavigationLabel(): string
    {
        return 'Theme Settings';
    }
}
