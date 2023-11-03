<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Artisan;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use WireUi\Heroicons\HeroiconsServiceProvider;
use WireUi\ServiceProvider;

class TestCase extends TestbenchTestCase
{
    use Interacts;
    use InteractsWithViews;

    protected function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });

        parent::setUp();
    }

    protected function defineWebRoutes($router)
    {
        base_path('src/routes/web.php');
    }

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
            LivewireServiceProvider::class,
            HeroiconsServiceProvider::class,
        ];
    }

    public function makeACleanSlate(): void
    {
        Artisan::call('view:clear');
    }
}
