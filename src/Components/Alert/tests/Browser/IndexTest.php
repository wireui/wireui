<?php

namespace WireUi\Components\Alert\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class IndexTest extends BrowserTestCase
{
    public function test_alert_component(): void
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
                        <x-alert>
                            <x-slot name="action">
                                <x-button wire:click="toggle" dusk="button" label="Click" />
                            </x-slot>

                            <x-slot name="title" dusk="title">
                                @if ($show)
                                    Alert is open!
                                @else
                                    Alert is closed!
                                @endif
                            </x-slot>
                        </x-alert>
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@title', 'Alert is closed!')
            ->click('@button')
            ->waitForTextIn('@title', 'Alert is open!');
    }
}
