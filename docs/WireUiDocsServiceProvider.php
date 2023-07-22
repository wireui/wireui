<?php

namespace WireUiDocs;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use WireUiDocs\Middleware\CheckPage;
use WireUiDocs\View\Components\Code;

class WireUiDocsServiceProvider extends ServiceProvider
{
    public const PACKAGE_NAME = 'wireui-docs';

    /**
     * Register services.
     */
    public function register(): void
    {
        $name = self::PACKAGE_NAME;

        $this->mergeConfigFrom(__DIR__ . '/config.php', $name);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViews();

        $this->publishesFiles();

        $this->registerMiddleware();
    }

    /**
     * Load the package's views.
     */
    private function loadViews(): void
    {
        $this->loadViewComponentsAs('docs', [Code::class]);

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'docs');
    }

    /**
     * Publishes files.
     */
    private function publishesFiles(): void
    {
        $name = self::PACKAGE_NAME;

        $this->publishes([
            __DIR__ . '/config.php' => config_path("{$name}.php"),
        ], "{$name}.config");
    }

    /**
     * Register the package's middleware.
     */
    private function registerMiddleware(): void
    {
        $router = $this->app->make(Router::class);

        $router->aliasMiddleware('check.page', CheckPage::class);
    }
}
