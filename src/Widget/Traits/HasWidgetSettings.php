<?php

namespace Raakkan\ThemesManager\Widget\Traits;

trait HasWidgetSettings
{
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
}