<?php

namespace WireUi\Components\Badge\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Attributes\On;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;
use WireUi\Components\Badge\WireUi\Color\{Flat, Outline, Solid};

class BaseTest extends BrowserTestCase
{
    public function test_base_badge_flat_component(): void
    {
        $flat = collect((new Flat())->all())->map(fn ($value, $key) => [
            'color' => $key,
            'class' => $value,
        ])->random();

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
                        <x-badge dusk="badge" label="Flat" :color="$color" flat />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'Flat')
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.Livewire.dispatch('set-color', { color: '{$flat['color']}' })
            EOT))
            ->pause(500)
            ->assertAttributeContains('@badge', 'class', data_get($flat, 'class'));
    }

    public function test_base_badge_solid_component(): void
    {
        $solid = collect((new Solid())->all())->map(fn ($value, $key) => [
            'color' => $key,
            'class' => $value,
        ])->random();

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
                        <x-badge dusk="badge" label="Solid" :color="$color" solid />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'Solid')
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.Livewire.dispatch('set-color', { color: '{$solid['color']}' })
            EOT))
            ->pause(500)
            ->assertAttributeContains('@badge', 'class', data_get($solid, 'class'));
    }

    public function test_base_badge_outline_component(): void
    {
        $outline = collect((new Outline())->all())->map(fn ($value, $key) => [
            'color' => $key,
            'class' => $value,
        ])->random();

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
                        <x-badge dusk="badge" label="Outline" :color="$color" outline />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'Outline')
            ->tap(fn (Browser $browser) => $browser->script(<<<EOT
                window.Livewire.dispatch('set-color', { color: '{$outline['color']}' })
            EOT))
            ->pause(500)
            ->assertAttributeContains('@badge', 'class', data_get($outline, 'class'));
    }
}
