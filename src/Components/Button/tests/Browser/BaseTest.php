<?php

namespace WireUi\Components\Button\tests\Browser;

use Illuminate\Support\Arr;
use Laravel\Dusk\Browser;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;
use WireUi\Components\Button\WireUi\Color\Flat;
use WireUi\Components\Button\WireUi\Color\Light;
use WireUi\Components\Button\WireUi\Color\Outline;
use WireUi\Components\Button\WireUi\Color\Solid;
use WireUi\Enum\Packs\Color;

class BaseTest extends BrowserTestCase
{
    public function test_base_button_flat_component(): void
    {
        $flat = $this->getRandomPack(Flat::class, [Color::NONE]);

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
                        <x-button dusk="button" label="Flat" :color="$color" flat />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@button', 'Flat')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$flat['key']}' })
            JS))
            ->waitTo(function (Browser $browser) use ($flat) {
                return $browser->assertAttributeContains(
                    '@button', 'class', Arr::toRecursiveCssClasses(data_get($flat, 'class')),
                );
            });
    }

    public function test_base_button_solid_component(): void
    {
        $solid = $this->getRandomPack(Solid::class, [Color::NONE]);

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
                        <x-button dusk="button" label="Solid" :color="$color" solid />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@button', 'Solid')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$solid['key']}' })
            JS))
            ->waitTo(function (Browser $browser) use ($solid) {
                return $browser->assertAttributeContains(
                    '@button', 'class', Arr::toRecursiveCssClasses(data_get($solid, 'class')),
                );
            });
    }

    public function test_base_button_light_component(): void
    {
        $light = $this->getRandomPack(Light::class, [Color::NONE]);

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
                        <x-button dusk="button" label="Light" :color="$color" light />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@button', 'Light')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$light['key']}' })
            JS))
            ->waitTo(function (Browser $browser) use ($light) {
                return $browser->assertAttributeContains(
                    '@button', 'class', Arr::toRecursiveCssClasses(data_get($light, 'class')),
                );
            });
    }

    public function test_base_button_outline_component(): void
    {
        $outline = $this->getRandomPack(Outline::class, [Color::NONE]);

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
                        <x-button dusk="button" label="Outline" :color="$color" outline />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@button', 'Outline')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', { color: '{$outline['key']}' })
            JS))
            ->waitTo(function (Browser $browser) use ($outline) {
                return $browser->assertAttributeContains(
                    '@button', 'class', Arr::toRecursiveCssClasses(data_get($outline, 'class')),
                );
            });
    }
}
