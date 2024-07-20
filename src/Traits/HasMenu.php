<?php

namespace Raakkan\ThemesManager\Traits;

trait HasMenu
{
    public function getMenuLocations(): array
    {
        if ($this->hasThemeClass()) {
            return $this->themeClass::getMenuLocations();
        }

        return [];
    }
}
