<?php

namespace Raakkan\ThemesManager;

abstract class BaseTheme
{
    public static function getFilamentPages(): array
    {
        return [];
    }

    public static function getMenus(): array
    {
        return [];
    }

    public static function getMenuItems(): array
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

    public static function getWidgets(): array
    {
        return [];
    }

    public static function getWidgetLocations(): array
    {
        return [
        ];
    }
}
