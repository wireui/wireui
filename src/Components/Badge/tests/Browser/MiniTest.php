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

class MiniTest extends BrowserTestCase
{
    public function test_mini_badge_flat_component(): void
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
                        <x-mini-badge dusk="badge" label="F" :color="$color" flat />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'F')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$flat['key']}' })
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertAttributeContains(
                '@badge', 'class', data_get($flat, 'class'),
            ));
    }

    public function test_mini_badge_solid_component(): void
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
                        <x-mini-badge dusk="badge" label="S" :color="$color" solid />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'S')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$solid['key']}' })
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertAttributeContains(
                '@badge', 'class', data_get($solid, 'class'),
            ));
    }

    public function test_mini_badge_outline_component(): void
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
                        <x-mini-badge dusk="badge" label="O" :color="$color" outline />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'O')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$outline['key']}' })
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertAttributeContains(
                '@badge', 'class', data_get($outline, 'class'),
            ));
    }
}
