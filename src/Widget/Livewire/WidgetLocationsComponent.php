<?php

namespace Raakkan\ThemesManager\Widget\Livewire;

use Livewire\Component;
use Filament\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Raakkan\ThemesManager\Models\ThemeWidget;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Filament\Forms\Concerns\InteractsWithForms;
use Raakkan\ThemesManager\Facades\ThemesManager;
use Filament\Actions\Concerns\InteractsWithActions;
use Raakkan\ThemesManager\Models\ThemeWidgetLocation;

class WidgetLocationsComponent extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ThemeWidgetLocation $location;
    public $selectedWidget = '';
    protected $listeners = ['widgetRemoved'];

    public function mount()
    {
    }

    public function widgetRemoved($widgetId)
    {
        $this->location->refresh();
    }

    public function addWidget()
    {
        if (!empty($this->selectedWidget)) {
            $widget = ThemesManager::get(ThemeSetting::getCurrentTheme())->getWidget($this->selectedWidget);
            $themeWidget = ThemeWidget::create([
                'widget_id' => $widget->getId(),
                'name' => $widget->getName(), 
                'source' => $widget->getSource(),
                'order' => count($this->location->widgets) + 1,
                'theme_widget_location_id' => $this->location->id
            ]);

            $this->location->refresh();

            Notification::make()
                    ->title('Widget added')
                    ->success()
                    ->send();
        }
    }

    public function getThemeWidgets(): array
    {
        if(ThemeSetting::getCurrentTheme() === null) {
            return [];
        }

        return ThemesManager::get(ThemeSetting::getCurrentTheme())->getWidgets();
    }
    
    public function render()
    {
        return view('themes-manager::livewire.widget-locations-component');
    }
}
