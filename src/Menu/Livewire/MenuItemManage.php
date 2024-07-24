<?php

namespace Raakkan\ThemesManager\Menu\Livewire;

use Livewire\Component;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Livewire\Attributes\Reactive;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Raakkan\ThemesManager\Models\ThemeMenu;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Filament\Forms\Concerns\InteractsWithForms;
use Raakkan\ThemesManager\Models\ThemeMenuItem;
use Raakkan\ThemesManager\Facades\ThemesManager;
use Filament\Actions\Concerns\InteractsWithActions;

class MenuItemManage extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    
    public ThemeMenu $menu;

    public $menuItems;
    public $predefinedItems = [
        ['id' => '1', 'name' => 'Home', 'order' => 1, 'url' => '', 'icon' => '', 'children' => []],
        ['id' => '2', 'name' => 'About', 'order' => 1, 'url' => '', 'icon' => '', 'children' => []],
    ];

    public $selectedItem;

    public function mount()
    {
        $this->menuItems = $this->menu->items()->with('children')->whereNull('parent_id')->orderBy('order')->get();
    }

    public function addMenuItem($item)
    {
        ThemeMenuItem::addMenuItem($this->menu, $item);
        Notification::make()
                    ->title('Menu item added')
                    ->success()
                    ->send();
        $this->menuItems = $this->menu->items()->with('children')->whereNull('parent_id')->orderBy('order')->get();
    }

    public function addAsChild($item)
    {
        if ($this->selectedItem) {
            ThemeMenuItem::addAsChild($this->menu, $item, $this->selectedItem['id']);
            Notification::make()
                    ->title('Menu item added')
                    ->success()
                    ->send();
            $this->menuItems = $this->menu->items()->with('children')->whereNull('parent_id')->orderBy('order')->get();
        }
    }

    public function updateMenuItemOrder($itemId, $position)
    {
        $menuItem = ThemeMenuItem::find($itemId);
        
        if ($menuItem) {
            $menuItem->updateOrder($position);
            $this->menuItems = $this->menu->items()->with('children')->whereNull('parent_id')->orderBy('order')->get();
        }
    }

    public function getMenuItems(): array
    {
        if(ThemeSetting::getCurrentTheme() === null) {
            return [];
        }

        return ThemesManager::get(ThemeSetting::getCurrentTheme())->getMenuItems();
    }

    public function setSelectedItem($item)
    {
        $this->selectedItem = $item;
    }

    public function getSelectedItem()
    {
        return ThemeMenuItem::find($this->selectedItem['id']);
    }

    public function editAction(): Action
    {
        return EditAction::make('edit')
        ->record($this->getSelectedItem())
            ->label('Edit')
            ->link()
            ->color('info')
            ->form([
                TextInput::make('name')->required(),
                TextInput::make('url')->required(),
            ])
            ->action(function (array $data) {
                $this->getSelectedItem()->update($data);
                Notification::make()
                    ->title('Menu item updated')
                    ->success()
                    ->send();
                $this->menuItems = $this->menu->items()->with('children')->whereNull('parent_id')->orderBy('order')->get();
            });
    }

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->requiresConfirmation()
            ->link()
            ->color('danger')
            ->action(function () {
                $this->getSelectedItem()->delete();
                Notification::make()
                    ->title('Menu item deleted')
                    ->success()
                    ->send();
                $this->menuItems = $this->menu->items()->with('children')->whereNull('parent_id')->orderBy('order')->get();
            });
    }

    public function render()
    {
        return view('themes-manager::livewire.menu-item-manage');
    }
}