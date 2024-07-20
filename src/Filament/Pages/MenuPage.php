<?php

namespace Raakkan\ThemesManager\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Raakkan\ThemesManager\Models\ThemeMenu;
use Raakkan\ThemesManager\Models\ThemeSetting;
use Raakkan\ThemesManager\Facades\ThemesManager;

class MenuPage extends Page
{
    protected static string $view = 'themes-manager::filament.pages.menu-page';

    protected static ?string $navigationGroup = 'Appearance';

    public $menus;
    public $name;
    public $location;
    public $is_active;

    public $selectedMenu;

    public function mount()
    {
        $this->menus = ThemeMenu::all();

        $this->selectedMenu = $this->menus->first()->id;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createMenu')
                ->label('Create Menu')
                ->form([
                    TextInput::make('name')->required(),
                    Select::make('location')
                        ->options($this->getMenuLocations())
                        ->required(),
                    Toggle::make('is_active'),
                ])
                ->action(function (array $data): void {
                    ThemeMenu::create($data);
                    $this->menus = ThemeMenu::all();
                }),
        ];
    }

    public function editAction(): Action
    {
        return EditAction::make('edit')
        ->record($this->getSelectedMenu())
            ->label('Edit Menu')
            ->form([
                TextInput::make('name')->required(),
                Select::make('location')
                    ->options($this->getMenuLocations())
                    ->required(),
                Toggle::make('is_active'),
            ])
            ->action(function (array $data) {
                $this->getSelectedMenu()->update($data);
                $this->menus = ThemeMenu::all();
            });
    }

    public function getSelectedMenu()
    {
        return ThemeMenu::find($this->selectedMenu);
    }

    public function getMenuLocations(): array
    {
        $themeLocations = ThemesManager::get(ThemeSetting::getCurrentTheme())->getMenuLocations();
        
        return array_merge($themeLocations, [
            'header' => 'Header',
            'footer' => 'Footer',
        ]);
    }

    public function getTitle(): string
    {
        return 'Menus';
    }

    public static function getNavigationLabel(): string
    {
        return 'Menus';
    }
}
