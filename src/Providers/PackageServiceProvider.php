<?php

declare(strict_types=1);

namespace Raakkan\ThemesManager\Providers;

use Livewire\Livewire;
use Illuminate\Support\Str;
use Illuminate\Routing\Router;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Raakkan\ThemesManager\ThemesManager;
use Raakkan\ThemesManager\Http\Middleware;
use Raakkan\ThemesManager\Components\Image;
use Raakkan\ThemesManager\Components\Style;
use Raakkan\ThemesManager\Console\Commands;
use Raakkan\ThemesManager\Components\Script;
use Raakkan\ThemesManager\Console\Generators;
use Raakkan\ThemesManager\ThemeManagerConfig;
use Raakkan\ThemesManager\Components\PageTitle;
use Raakkan\ThemesManager\Facades\ThemesManager as ThemesManagerFacade;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Name for this package to publish assets.
     */
    protected const PACKAGE_NAME = 'themes-manager';

    /**
     * Pblishers list.
     */
    protected $publishers = [];

    /**
     * Bootstrap the application events.
     */
    public function boot(Router $router): void
    {
        $this->loadViewsFrom($this->getPath('resources/views'), 'themes-manager');
        // $this->loadViewComponentsAs('theme', [
        //     Image::class,
        //     PageTitle::class,
        //     Script::class,
        //     Style::class,
        // ]);

        $this->strapPublishers();
        $this->strapCommands();

        $router->aliasMiddleware('theme', Middleware\ThemeLoader::class);
        $this->registerLivewireComponents();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->registerConfigs();

        $this->app->singleton('themes-manager', function () {
            return new ThemesManager();
        });

        $this->app->singleton('themes-manager-config', function () {
            return new ThemeManagerConfig();
        });

        AliasLoader::getInstance()->alias('ThemesManager', ThemesManagerFacade::class);
        AliasLoader::getInstance()->alias('Theme', ThemesManagerFacade::class);

        $this->app->register(BladeServiceProvider::class);
    }

    public function registerLivewireComponents(): void
    {
        Livewire::component('theme::livewire.menu-item-manage', \Raakkan\ThemesManager\Menu\Livewire\MenuItemManage::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [ThemesManager::class];
    }

    /**
     * Get Package absolute path.
     */
    protected function getPath(string $path = '')
    {
        // We get the child class
        $rc = new \ReflectionClass(static::class);

        return dirname($rc->getFileName()) . '/../../' . $path;
    }

    /**
     * Get Module normalized namespace.
     */
    protected function getNormalizedNamespace(mixed $prefix = '')
    {
        return Str::start(Str::lower(self::PACKAGE_NAME), $prefix);
    }

    /**
     * Bootstrap our Configs.
     */
    protected function registerConfigs(): void
    {
        $configPath = $this->getPath('config');

        $this->mergeConfigFrom(
            "{$configPath}/config.php",
            $this->getNormalizedNamespace()
        );
    }

    protected function strapCommands(): void
    {
        if ($this->app->runningInConsole() || config('app.env') === 'testing') {
            $this->commands([
                Commands\ClearCache::class,
                Commands\ListThemes::class,
                Generators\MakeTheme::class,
            ]);
        }
    }

    /**
     * Bootstrap our Publishers.
     */
    protected function strapPublishers(): void
    {
        $configPath = $this->getPath('config');

        $this->publishes([
            "{$configPath}/config.php" => config_path($this->getNormalizedNamespace() . '.php'),
        ], 'config');

        $this->publishes([
            $this->getPath('resources/views') => resource_path('views/vendor/themes-manager'),
        ], 'views');

        $this->publishes([
            $this->getPath('database/migrations') => database_path('migrations'),
        ], 'migrations');
    
    }
}
