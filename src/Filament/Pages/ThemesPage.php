<?php

namespace Raakkan\ThemesManager\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Raakkan\ThemesManager\Facades\ThemesManager;
use Raakkan\ThemesManager\Facades\ThemeManagerConfig;
use Raakkan\ThemesManager\Filament\FrontEndThemePlugin;

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

        if (ThemeManagerConfig::isSettingsEnabled() && Schema::hasTable('theme_settings')) {
            ThemeSetting::set('current_theme', $vendor . '/' . $themeName);
        }
        return redirect(request()->header('Referer'));
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
