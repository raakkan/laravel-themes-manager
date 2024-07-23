<?php

namespace Raakkan\ThemesManager\Widget\Livewire;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Raakkan\ThemesManager\Models\ThemeWidget;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Filament\Forms\Concerns\InteractsWithForms;
use Raakkan\ThemesManager\Facades\ThemesManager;
use Raakkan\ThemesManager\Models\ThemeWidgetLocation;

class WidgetComponent extends Component implements HasForms
{
    use InteractsWithForms;
    public ThemeWidgetLocation $location;
    public ThemeWidget $widget;

    public ?array $settings = [];

    public function mount()
    {
        $this->form->fill($this->widget->settings);
    }

    public function removeWidget()
    {
        $widgetId = $this->widget->id;
        $this->widget->deleteAndAdjustOrder();
        Notification::make()
            ->title('Widget removed')
            ->success()
            ->send();
        $this->dispatch('widgetRemoved', $widgetId);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getThemeWidgetSettings())
            ->statePath('settings');
    }

    public function saveSettings()
    {
        $this->widget->update([
            'settings' => $this->form->getState(),
        ]);

        Notification::make()
            ->title('Widget settings saved')
            ->success()
            ->send();
    }

    public function getThemeWidgetSettings(): array
    {
        if(ThemeSetting::getCurrentTheme() === null) {
            return [];
        }
        
        if(!ThemesManager::get(ThemeSetting::getCurrentTheme())->hasWidgetSettings($this->widget->widget_id))
        {
            return [];
        }

        $settings = ThemesManager::get(ThemeSetting::getCurrentTheme())->getWidgetSettings($this->widget->widget_id);

        foreach ($settings as $field) {
            if ($field->getDefaultState() && !isset($this->widget->settings[$field->getName()])) {
                $widgetSettings = $this->widget->settings ?? [];
                $this->widget->update([
                    'settings' => array_merge($widgetSettings, [$field->getName() => $field->getDefaultState()]),
                ]);
            }
        }
        
        return $settings;
    }
    
    public function render()
    {
        return view('themes-manager::livewire.widget-component');
    }
}
