<?php

namespace WireUi\Components\Link\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;
use WireUi\Components\Link\WireUi\Color;
use WireUi\Components\Link\WireUi\Underline;

class IndexTest extends BrowserTestCase
{
    public function test_link_color_component(): void
    {
        $color = $this->getRandomPack(Color::class);

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
                        <x-link dusk="badge" label="Flat" :color="$color" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'Flat')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-color', {
                    color: '{$color['key']}',
                })
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertAttributeContains(
                '@badge', 'class', data_get($color, 'class'),
            ));
    }

    public function test_link_underline_component(): void
    {
        $underline = $this->getRandomPack(Underline::class);

        Livewire::visit(new class extends Component
        {
            public mixed $underline = null;

            #[On('set-underline')]
            public function setUnderline(string $underline): void
            {
                $this->underline = $underline;
            }

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-link dusk="badge" label="Flat" :underline="$underline" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@badge', 'Flat')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                window.Livewire.dispatch('set-underline', { underline: '{$underline['key']}' })
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertAttributeContains(
                '@badge', 'class', data_get($underline, 'class'),
            ));
    }
}
