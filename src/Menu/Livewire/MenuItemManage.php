<?php

namespace Raakkan\ThemesManager\Menu\Livewire;

use Livewire\Component;
use Livewire\Attributes\Reactive;
use Raakkan\ThemesManager\Models\ThemeMenu;

class MenuItemManage extends Component
{
    #[Reactive] 
    public ThemeMenu $menu;

    public $menuItems;

    public function mount()
    {
        $this->menuItems = $this->menu->items ?? [];
    }

    public function render()
    {
        return view('themes-manager::livewire.menu-item-manage');
    }
}