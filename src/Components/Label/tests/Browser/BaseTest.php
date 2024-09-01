<?php

namespace WireUi\Components\Label\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class BaseTest extends BrowserTestCase
{
    public function test_label_component(): void
    {
        Livewire::visit(new class extends Component
        {
            public string $label = 'Label 1';

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-label dusk="label" :text="$label" />

                        <x-button wire:click="$set('label', 'Label 2')" label="Change" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@label', 'Label 1')
            ->press('Change')
            ->waitForTextIn('@label', 'Label 2');
    }
}
