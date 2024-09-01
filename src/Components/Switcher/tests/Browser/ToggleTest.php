<?php

namespace WireUi\Components\Switcher\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class ToggleTest extends BrowserTestCase
{
    public function test_toggle_component(): void
    {
        Livewire::visit(new class extends Component
        {
            #[Validate('accepted', message: 'accept it')]
            public bool $toggle = false;

            public function save(): void
            {
                $this->validate();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="toggle" :label="json_encode($toggle)" />

                    <x-toggle wire:model.live="toggle" label="Enable Notifications" />

                    <x-button dusk="validate" wire:click="save" label="Save" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Enable Notifications')
            ->click('#toggle')
            ->assertChecked('toggle')
            ->waitForTextIn('@toggle', 'true')
            ->click('#toggle')
            ->assertNotChecked('toggle')
            ->waitForTextIn('@toggle', 'false')
            ->click('@validate')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('accept it'));
    }
}
