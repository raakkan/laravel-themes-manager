<?php

namespace Raakkan\ThemesManager\Filament;

use Filament\Panel;
use Filament\Contracts\Plugin;
use Illuminate\Support\Facades\Log;
use Filament\Navigation\NavigationGroup;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Raakkan\ThemesManager\Facades\ThemesManager;

class FrontEndThemePlugin implements Plugin
{
    protected $pages = [Pages\ThemesPage::class,];

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
        ThemesManager::set(ThemeSetting::getCurrentTheme());
        $themePages = array_merge($this->pages, ThemesManager::get(ThemeSetting::getCurrentTheme())->getFilamentPages());

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
        $this->pages = array_merge($this->pages, [
            Pages\MenuPage::class,
        ]);

        return $this;
    }
}
