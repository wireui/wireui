<?php

namespace WireUi\Components\Alert\tests\Browser;

use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class IndexTest extends BrowserTestCase
{
    public function test_alert_component(): void
    {
        Livewire::visit(new class() extends Component
        {
            public bool $show = false;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-alert>
                            <x-slot name="action">
                                <button dusk="button" label="Click" />
                            </x-slot>

                            <x-slot id="open" name="title">
                                Alert is open!
                            </x-slot>

                            <x-slot id="close" name="title">
                                Alert is closed!
                            </x-slot>
                        </x-alert>
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()

            // ->pause(10000000000000)

            ->typeSlowly('color', 'FFF')
            ->assertInputValue('color', '#FFF')
            ->waitForTextIn('@value', '#FFF')

            ->typeSlowly('color', '000')
            ->assertInputValue('color', '#000')
            ->waitForTextIn('@value', '#000');
    }
}
