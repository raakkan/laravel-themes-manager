<?php

namespace Raakkan\ThemesManager;

abstract class BaseTheme
{
    public static function getFilamentPages(): array
    {
        return [];
    }

    public static function getMenuLocations(): array
    {
        return [
            'header' => 'Header',
            'footer' => 'Footer',
        ];
    }
}
