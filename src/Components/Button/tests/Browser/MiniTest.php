<?php

namespace WireUi\Components\Button\tests\Browser;

use Illuminate\Support\Arr;
use Laravel\Dusk\Browser;
use Livewire\Attributes\On;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;
use WireUi\Components\Button\WireUi\Color\{Flat, Light, Outline, Solid};
use WireUi\Enum\Packs\Color;

class MiniTest extends BrowserTestCase
{
    public function test_mini_button_flat_component(): void
    {
        $flat = $this->getRandomPack(Flat::class, [Color::NONE]);

        Livewire::visit(new class() extends Component
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
                        <x-mini-button dusk="button" label="F" :color="$color" flat />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@button', 'F')
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.Livewire.dispatch('set-color', { color: '{$flat['key']}' })
            EOT))
            ->waitTo(function (Browser $browser) use ($flat) {
                return $browser
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($flat, 'class.base')))
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($flat, 'class.hover')))
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($flat, 'class.focus')));
            });
    }

    public function test_mini_button_solid_component(): void
    {
        $solid = $this->getRandomPack(Solid::class, [Color::NONE]);

        Livewire::visit(new class() extends Component
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
                        <x-mini-button dusk="button" label="L" :color="$color" solid />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@button', 'L')
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.Livewire.dispatch('set-color', { color: '{$solid['key']}' })
            EOT))
            ->waitTo(function (Browser $browser) use ($solid) {
                return $browser
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($solid, 'class.base')))
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($solid, 'class.hover')))
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($solid, 'class.focus')));
            });
    }

    public function test_mini_button_light_component(): void
    {
        $light = $this->getRandomPack(Light::class, [Color::NONE]);

        Livewire::visit(new class() extends Component
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
                        <x-mini-button dusk="button" label="S" :color="$color" light />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@button', 'S')
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.Livewire.dispatch('set-color', { color: '{$light['key']}' })
            EOT))
            ->waitTo(function (Browser $browser) use ($light) {
                return $browser
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($light, 'class.base')))
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($light, 'class.hover')))
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($light, 'class.focus')));
            });
    }

    public function test_mini_button_outline_component(): void
    {
        $outline = $this->getRandomPack(Outline::class, [Color::NONE]);

        Livewire::visit(new class() extends Component
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
                        <x-mini-button dusk="button" label="O" :color="$color" outline />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@button', 'O')
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.Livewire.dispatch('set-color', { color: '{$outline['key']}' })
            EOT))
            ->waitTo(function (Browser $browser) use ($outline) {
                return $browser
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($outline, 'class.base')))
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($outline, 'class.hover')))
                    ->assertAttributeContains('@button', 'class', $this->getClasses(data_get($outline, 'class.focus')));
            });
    }

    private function getClasses(mixed $class): string
    {
        return collect(Arr::wrap($class))->implode(' ');
    }
}
