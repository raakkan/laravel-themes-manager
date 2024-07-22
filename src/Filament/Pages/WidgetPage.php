<?php

namespace Raakkan\ThemesManager\Filament\Pages;

use Filament\Pages\Page;

class WidgetPage extends Page
{
    protected static string $view = 'themes-manager::filament.pages.widget-page';

    protected static ?string $navigationGroup = 'Appearance';

    public array $themeWidgets = [
        [
            'name' => 'widget 1'
        ],
        [
            'name' => 'widget 2'
        ],
        [
            'name' => 'widget 3'
        ],
        [
            'name' => 'widget 4'
        ],
        [
            'name' => 'widget 5'
        ],
    ];

    public array $themeWidgetLocations = [
        'footer' => [
            'name' => 'footer',
            'label' => 'Footer',
            'widgets' => [
            ],
        ],
        'header' => [
            'name' => 'header',
            'label' => 'Header',
            'widgets' => [
            ],
        ],
        'sidebar' => [
            'name' => 'sidebar',
            'label' => 'Sidebar',
            'widgets' => [
            ],
        ]
    ];

    public function mount()
    {
    }

    public function getTitle(): string
    {
        return 'Widgets';
    }

    public static function getNavigationLabel(): string
    {
        return 'Widgets';
    }
}
