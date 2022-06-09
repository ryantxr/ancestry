<?php

namespace Ryantxr\Quake;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory;
use Ryantxr\Quake\Events\BuildingMenu;


// use VendorPackage\View\Components\AlertComponent;

class QuakeServiceProvider extends ServiceProvider
{
    /**
     * The prefix to use for register/load the package resources.
     *
     * @var string
     */
    protected $pkgPrefix = 'quake';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Factory $view, Dispatcher $events, Repository $config): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ryantxr');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'ryantxr');
        $this->loadViews();
        $this->registerComponents();
        $this->registerMenu($events, $config);
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->publishConfig();
        // Publishing is only necessary when using the CLI.
        
        // $this->registerCommands();

        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/quake.php', 'quake');

        // Register the service the package provides.
        $this->app->singleton('quake', function ($app) {
            return new Quake($app['events'], $app);
        });
    }

    private function loadViews()
    {
        $viewsPath = $this->packagePath('resources/views');

        $this->loadViewsFrom($viewsPath, 'quake');

        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/quake'),
        ], 'views');
    }

    /**
     * Register all anonymous components
     * Components can have a corresponding class or not (AKA anonymous).
     * Here we only use anonymous components.
     */
    private function registerComponents()
    {
        $components = [
            'layout',
            'message',
            'form.tag'
        ];
        foreach ( $components as $component ) {
            $this->registerComponent($component);
        }
        
    }
    
    /**
     * Register an anonymous component
     * Use components in blade files like this <x-quake-blah>
     * Component has no corresponding class.
     * @param string $component - the component to register
     */
    private function registerComponent(string $component)
    {
        Blade::component("quake::components.{$component}", "quake-{$component}");
    }

    /**
     * 
     */
    private function publishConfig()
    {
        $configPath = $this->packagePath('config/quake.php');

        $this->publishes([
            $configPath => config_path('quake.php'),
        ], 'config');

        $this->mergeConfigFrom($configPath, 'quake');
    }

    /**
     * 
     */
    public function registerCommands()
    {
        // $this->commands([
            // QuakeInstallCommand::class,
            // QuakeStatusCommand::class,
            // QuakeUpdateCommand::class,
            // QuakePluginCommand::class,
        // ]);
    }

    /**
     * Register the menu events handlers.
     *
     * @return void
     */
    private static function registerMenu(Dispatcher $events, Repository $config)
    {
        // Register a handler for the BuildingMenu event, this handler will add
        // the menu defined on the config file to the menu builder instance.

        $events->listen(
            BuildingMenu::class,
            function (BuildingMenu $event) use ($config) {
                $menu = $config->get('quake.menu', []);
                $menu = is_array($menu) ? $menu : [];
                $event->menu->add(...$menu);
            }
        );
    }

    /**
     * 
     */
    private function packagePath($path)
    {
        return __DIR__."/../$path";
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['quake'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/quake.php' => config_path('quake.php'),
        ], 'quake.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/ryantxr'),
        ], 'quake.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/ryantxr'),
        ], 'quake.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/ryantxr'),
        ], 'quake.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
