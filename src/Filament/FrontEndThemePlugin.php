<?php

namespace Raakkan\ThemesManager\Filament;

use Filament\Panel;
use Filament\Contracts\Plugin;

class FrontEndThemePlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'front-end-theme';
    }
 
    public function register(Panel $panel): void
    {
        $panel
            ->resources([
            ])
            ->pages([
                Pages\ThemesPage::class,
            ]);
    }
 
    public function boot(Panel $panel): void
    {
        //
    }
}
