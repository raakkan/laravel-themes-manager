<?php

namespace Raakkan\ThemesManager\Filament\Pages;

use Filament\Pages\Page;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Raakkan\ThemesManager\Facades\ThemesManager;

// TODO: theme delete and page refrsh
class ThemesPage extends Page
{
    protected static string $view = 'themes-manager::filament.pages.themes-page';

    protected static ?string $navigationGroup = 'Appearance';

    public function mount()
    {
    }
    
    public function getThemes()
    {
        return ThemesManager::all();
    }

    public function getActiveTheme()
    {
        return ThemesManager::current();
    }

    public function activateTheme($themeName, $vendor)
    {
        ThemesManager::set($vendor . '/' . $themeName);

        ThemeSetting::set('current_theme', $vendor . '/' . $themeName);
    }

    public function getTitle(): string
    {
        return 'Themes';
    }

    public static function getNavigationLabel(): string
    {
        return 'Themes';
    }
}
