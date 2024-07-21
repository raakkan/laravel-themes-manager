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
use Filament\Actions\Contracts\HasActions;
use Raakkan\ThemesManager\Models\ThemeMenu;
use Filament\Forms\Concerns\InteractsWithForms;
use Raakkan\ThemesManager\Models\ThemeMenuItem;
use Filament\Actions\Concerns\InteractsWithActions;

class MenuItemManage extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    
    #[Reactive] 
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
        $this->menuItems = $this->menu->items()->with('children')->whereNull('parent_id')->orderBy('order')->get();
    }

    public function addAsChild($item)
    {
        if ($this->selectedItem) {
            ThemeMenuItem::addAsChild($this->menu, $item, $this->selectedItem['id']);
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
                $this->menuItems = $this->menu->items()->with('children')->whereNull('parent_id')->orderBy('order')->get();
            });
    }

    public function render()
    {
        return view('themes-manager::livewire.menu-item-manage');
    }
}