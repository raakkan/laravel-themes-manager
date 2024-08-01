<?php

namespace Raakkan\ThemesManager\Builder\Filament\Pages;

use Filament\Pages\Page;
use Raakkan\ThemesManager\Builder\PageBuilder;

class PageBulderPage extends Page
{
    protected static string $view = 'themes-manager::builder.filament.pages.page-builder-page';

    protected static ?string $navigationGroup = 'Appearance';
    protected static ?string $slug = 'appearance/page-builder';

    public $builder = [];

    public function mount()
    {
    }

    public function save()
    {
        dd($this->builder);
    }

    public function getPageBuilder(): PageBuilder
    {
        return PageBuilder::make('page-builder')->header()->footer()->sidebar('right')->heroSection()->callToAction();
    }

    public function getTitle(): string
    {
        return 'Page Builder';
    }

    public static function getNavigationLabel(): string
    {
        return 'Page Builder';
    }
}