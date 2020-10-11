<?php

namespace Kineticamobile\Lumki;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LumkiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kineticamobile');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lumki');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->registerBladeDirectives();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lumki.php', 'lumki');

        // Register the service the package provides.
        $this->app->singleton('lumki', function ($app) {
            return new Lumki;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['lumki'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/lumki.php' => config_path('lumki.php'),
        ], 'lumki.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/kineticamobile'),
        ], 'lumki.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/kineticamobile'),
        ], 'lumki.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/kineticamobile'),
        ], 'lumki.views');*/

        // Registering package commands.
        $this->commands([
            Commands\SetupCommand::class,
        ]);
    }

    protected function registerBladeDirectives()
    {
        Blade::directive('lumki', function () {
            return
            Blade::compileString(
                  '@can(\'manage users\') '
                    . '<div class="block px-4 py-2 text-xs text-gray-400">Lumki</div>'

                    . '<a href="{{ route(\'lumki.index\') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">'
                        . '{{ __(\'Users\') }}'
                    . '</a>'
                    . '<a href="{{ route(\'lumki.roles.index\') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">'
                        . '{{ __(\'Roles\') }}'
                    . '</a>'
                    . '<a href="{{ route(\'lumki.permissions.index\') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">'
                        . '{{ __(\'Permissions\') }}'
                    . '</a>'
                . ' @endcan '
                . '@impersonating'
                    . '<div class="border-t border-gray-100"></div>'
                    . '<a href="{{ route(\'impersonate.leave\') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">'
                        . '{{ __(\'Leave impersonation\') }}'
                    . '</a>'
                . '@endImpersonating'

            );
        });
    }
}
