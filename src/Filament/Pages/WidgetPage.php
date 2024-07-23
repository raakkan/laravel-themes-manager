<?php

namespace Raakkan\ThemesManager\Filament\Pages;

use Filament\Pages\Page;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Raakkan\ThemesManager\Facades\ThemesManager;
use Raakkan\ThemesManager\Models\ThemeWidgetLocation;

class WidgetPage extends Page
{
    protected static string $view = 'themes-manager::filament.pages.widget-page';

    protected static ?string $navigationGroup = 'Appearance';

    public function mount()
    {
        // dd($this->getWidgetLocations());
    }

    public function getWidgetLocations()
    {
        if(ThemeSetting::getCurrentTheme() === null) {
            return [];
        }

        $themeLocations = ThemesManager::get(ThemeSetting::getCurrentTheme())->getWidgetLocations();
        $themeNamespace = ThemesManager::current()->getNamespace();

        $locations = [];
        foreach ($themeLocations as $location) {
            $locations[] = ThemeWidgetLocation::firstOrCreate(['name' => $location->getName(), 'label' => $location->getLabel(), 'source' => $themeNamespace]);
        }
        
        return $locations;
    }

    public function getTitle(): string
    {
        return 'Widgets';
    }

    public static function getNavigationLabel(): string
    {
        return 'Widgets';
    }
}
