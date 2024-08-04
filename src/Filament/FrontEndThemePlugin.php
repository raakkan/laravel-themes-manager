<?php

namespace Raakkan\ThemesManager\Filament;

use Filament\Panel;
use Filament\Contracts\Plugin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Filament\Navigation\NavigationGroup;
use Raakkan\ThemesManager\Builder\Filament\Pages\TemplatesPage;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Raakkan\ThemesManager\Facades\ThemesManager;
use Raakkan\ThemesManager\Facades\ThemeManagerConfig;

class FrontEndThemePlugin implements Plugin
{
    protected $pages = [
        Pages\ThemesPage::class,
        TemplatesPage::class,
    ];

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'front-end-themes';
    }
 
    public function register(Panel $panel): void
    {
        $themePages = $this->pages;

        if(Schema::hasTable('theme_settings') && ThemeSetting::getCurrentTheme() !== null) {
            ThemesManager::set(ThemeSetting::getCurrentTheme());
            $themePages = array_merge($themePages, ThemesManager::get(ThemeSetting::getCurrentTheme())->getFilamentPages());
        }

        $panel->pages($themePages)->navigationGroups([
            NavigationGroup::make()
                 ->label('Appearance')
                 ->icon('heroicon-o-paint-brush'),
        ]);
    }
 
    public function boot(Panel $panel): void
    {
        //
    }

    public function enableMenus()
    {
        ThemeManagerConfig::enableMenus();

        $this->pages = array_merge($this->pages, [
            Pages\MenuPage::class,
        ]);

        return $this;
    }

    public function enableWidgets()
    {
        ThemeManagerConfig::enableWidgets();

        $this->pages = array_merge($this->pages, [
            Pages\WidgetPage::class,
        ]);

        return $this;
    }

    public function enableSettings()
    {
        ThemeManagerConfig::enableSettings();
        return $this;
    }
}
