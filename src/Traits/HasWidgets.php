<?php

namespace Raakkan\ThemesManager\Traits;


trait HasWidgets
{
    protected $widgets = [];
    protected $widgetsLocations = [];
    protected $widgetsSettings = [];

    public function getWidgets(): array
    {
        return $this->widgets;
    }

    public function getWidgetLocations(): array
    {
        return $this->widgetsLocations;
    }

    public function getWidgetsSettings(): array
    {
        return $this->widgetsSettings;
    }

    public function getWidget(string $id)
    {
        return $this->widgets[$id];
    }

    public function hasWidget(string $id): bool
    {
        return array_key_exists($id, $this->widgets);
    }

    public function getWidgetSettings(string $id): array
    {
        return $this->widgetsSettings[$id];
    }

    public function hasWidgetSettings(string $id): bool
    {
        return $this->hasWidget($id) && $this->getWidget($id)->hasSettings();
    }

    public function loadWidgetsAndLocations()
    {
        if ($this->hasThemeClass()) {
            $this->makeWidgets($this->themeClass::getWidgets());
            $this->widgetsLocations = $this->themeClass::getWidgetLocations();
        }
    }

    public function makeWidgets($widgets)
    {
        foreach ($widgets as $widget) {
            $widget = new $widget();
            
            $widget->setSource($this->getNamespace());
            $this->widgets[$widget->getId()] = $widget;
            
            if ($widget->hasSettings()) {
                $this->widgetsSettings[$widget->getId()] = $widget->getSettings();
            }
        }
    }
}