<?php

namespace Raakkan\ThemesManager\Filament\Pages;

use Filament\Pages\Page;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Raakkan\ThemesManager\Facades\ThemesManager;

class ThemesPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'themes-manager::filament.pages.themes-page';
    public $search = '';

    public function mount()
    {
        
    }

    public function filteredThemes()
    {
        return $this->getThemes()->filter(function ($theme) {
            return str_contains(strtolower($theme->getName()), strtolower($this->search)) ||
                   str_contains(strtolower($theme->getDescription()), strtolower($this->search));
        });
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

        ThemeSetting::updateOrCreate(
            ['key' => 'current_theme'],
            ['value' => $vendor . '/' . $themeName]
        );
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
