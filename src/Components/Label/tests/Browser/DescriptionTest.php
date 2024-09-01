<?php

namespace WireUi\Components\Label\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class DescriptionTest extends BrowserTestCase
{
    public function test_description_component(): void
    {
        Livewire::visit(new class extends Component
        {
            public string $description = 'Description 1';

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-description dusk="description" :text="$description" />

                        <x-button wire:click="$set('description', 'Description 2')" label="Change" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertSeeIn('@description', 'Description 1')
            ->press('Change')
            ->waitForTextIn('@description', 'Description 2');
    }
}
