<?php

namespace WireUi\Components\Card\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class IndexTest extends BrowserTestCase
{
    public function test_card_component(): void
    {
        Livewire::visit(new class extends Component
        {
            public bool $show = false;

            public function toggle(): void
            {
                $this->show = ! $this->show;
            }

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-card>
                            <x-slot name="action">
                                <x-button wire:click="toggle" dusk="button" label="Click" />
                            </x-slot>

                            <x-slot name="title" dusk="title">
                                @if ($show)
                                    Card is open!
                                @else
                                    Card is closed!
                                @endif
                            </x-slot>
                        </x-card>
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@title', 'Card is closed!')
            ->click('@button')
            ->waitForTextIn('@title', 'Card is open!');
    }
}
