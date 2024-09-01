<?php

namespace WireUi\Components\Badge\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;
use WireUi\Components\Badge\WireUi\Color\Flat;
use WireUi\Components\Badge\WireUi\Color\Outline;
use WireUi\Components\Badge\WireUi\Color\Solid;

class BaseTest extends BrowserTestCase
{
    public function test_base_badge_flat_component(): void
    {
        $flat = $this->getRandomPack(Flat::class);

        Livewire::visit(new class extends Component
        {
            public mixed $color = null;

            #[On('set-color')]
            public function setColor(string $color): void
            {
                $this->color = $color;
            }

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-badge dusk="badge" label="Flat" :color="$color" flat />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'Flat')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$flat['key']}' })
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertAttributeContains(
                '@badge', 'class', data_get($flat, 'class'),
            ));
    }

    public function test_base_badge_solid_component(): void
    {
        $solid = $this->getRandomPack(Solid::class);

        Livewire::visit(new class extends Component
        {
            public mixed $color = null;

            #[On('set-color')]
            public function setColor(string $color): void
            {
                $this->color = $color;
            }

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-badge dusk="badge" label="Solid" :color="$color" solid />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'Solid')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$solid['key']}' })
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertAttributeContains(
                '@badge', 'class', data_get($solid, 'class'),
            ));
    }

    public function test_base_badge_outline_component(): void
    {
        $outline = $this->getRandomPack(Outline::class);

        Livewire::visit(new class extends Component
        {
            public mixed $color = null;

            #[On('set-color')]
            public function setColor(string $color): void
            {
                $this->color = $color;
            }

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-badge dusk="badge" label="Outline" :color="$color" outline />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'Outline')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$outline['key']}' })
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertAttributeContains(
                '@badge', 'class', data_get($outline, 'class'),
            ));
    }
}
