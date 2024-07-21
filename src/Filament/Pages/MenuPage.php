<?php

namespace Raakkan\ThemesManager\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
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

        if ($this->menus->count() > 0) {
            $this->selectedMenu = $this->menus->first()->id;
        }
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
                    TextInput::make('source')->disabled()->required()->default($this->getActiveThemeNamespace())->dehydrated(),
                ])
                ->action(function (array $data): void {
                    ThemeMenu::create($data);
                    Notification::make()
                    ->title('Menu created')
                    ->success()
                    ->send();
                    $this->menus = ThemeMenu::all();
                }),
        ];
    }

    public function editAction(): Action
    {
        return EditAction::make('edit')
        ->record($this->getSelectedMenu())
            ->label('Edit Menu')
            ->size(ActionSize::ExtraSmall)
            ->form([
                TextInput::make('name')->required(),
                Select::make('location')
                    ->options($this->getMenuLocations())
                    ->required(),
                Toggle::make('is_active'),
            ])
            ->action(function (array $data) {
                $this->getSelectedMenu()->update($data);
                Notification::make()
                    ->title('Menu updated')
                    ->success()
                    ->send();
                $this->menus = ThemeMenu::all();
            });
    }

    public function deleteAction(): Action
    {
        return DeleteAction::make('delete')
            ->record($this->getSelectedMenu())
            ->size(ActionSize::ExtraSmall)->successRedirectUrl(request()->header('Referer'));
    }

    public function getSelectedMenu()
    {
        return ThemeMenu::find($this->selectedMenu) ?? null;
    }

    public function getMenuLocations(): array
    {
        if(ThemeSetting::getCurrentTheme() === null) {
            return [
                'header' => 'Header',
                'footer' => 'Footer',
            ];
        }

        $themeLocations = ThemesManager::get(ThemeSetting::getCurrentTheme())->getMenuLocations();
        
        return array_merge($themeLocations, [
            'header' => 'Header',
            'footer' => 'Footer',
        ]);
    }

    public function getActiveThemeNamespace()
    {
        if(ThemeSetting::getCurrentTheme() === null) {
            return '';
        }

        return ThemesManager::current()->getNamespace();
    }

    public function getActiveTheme()
    {
        return ThemesManager::current();
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
