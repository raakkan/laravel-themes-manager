<?php

namespace Raakkan\ThemesManager;

final class ThemeManagerConfig
{
    protected $settingsEnabled = false;

    protected $menusEnabled = false;

    protected $widgetsEnabled = false;

    public function enableSettings()
    {
        $this->settingsEnabled = true;
        return $this;
    }

    public function enableMenus()
    {
        $this->menusEnabled = true;
        return $this;
    }

    public function enableWidgets()
    {
        $this->widgetsEnabled = true;
        return $this;
    }

    public function isSettingsEnabled()
    {
        return $this->settingsEnabled;
    }

    public function isMenusEnabled()
    {
        return $this->menusEnabled;
    }

    public function isWidgetsEnabled()
    {
        return $this->widgetsEnabled;
    }
}