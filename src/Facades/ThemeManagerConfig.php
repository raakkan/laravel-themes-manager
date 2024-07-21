<?php

declare(strict_types=1);

namespace Raakkan\ThemesManager\Facades;

use Illuminate\Support\Facades\Facade;

class ThemeManagerConfig extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'themes-manager-config';
    }
}
