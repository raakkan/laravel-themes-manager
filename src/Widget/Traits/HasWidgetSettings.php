<?php

namespace Raakkan\ThemesManager\Widget\Traits;

trait HasWidgetSettings
{
    protected $settings = [];

    public function settings(): array
    {
        return [];
    }

    public function getSettings(): array
    {
        return $this->settings();
    }

    public function hasSettings(): bool
    {
        return count($this->settings()) > 0;
    }

    public function loadSettings()
    {
        $this->settings = $this->getSettings();

        return $this;
    }
}