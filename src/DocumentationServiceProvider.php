<?php

namespace Mvdnbrk\Documentation;

use Illuminate\Support\ServiceProvider;
use Mvdnbrk\Documentation\Documentation;

class DocumentationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->offerPublishing();
    }

    public function register(): void
    {
        $this->configure();

        $this->app->alias(Documentation::class, 'documentation');
    }

    protected function configure(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/documentation.php', 'documentation'
        );
    }

    protected function offerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/documentation.php' => config_path('documentation.php'),
            ], 'documentation-config');
        }
    }
}
