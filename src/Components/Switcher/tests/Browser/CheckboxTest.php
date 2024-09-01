<?php

namespace WireUi\Components\Switcher\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class CheckboxTest extends BrowserTestCase
{
    public function test_checkbox_component(): void
    {
        Livewire::visit(new class extends Component
        {
            #[Validate('accepted', message: 'accept it')]
            public bool $checkbox = false;

            public function save(): void
            {
                $this->validate();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="checkbox" :label="json_encode($checkbox)" />

                    <x-checkbox wire:model.live="checkbox" label="Checkbox" />

                    <x-button dusk="validate" wire:click="save" label="Save" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Checkbox')
            ->check('checkbox')
            ->assertChecked('checkbox')
            ->waitForTextIn('@checkbox', 'true')
            ->uncheck('checkbox')
            ->assertNotChecked('checkbox')
            ->waitForTextIn('@checkbox', 'false')
            ->click('@validate')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('accept it'));
    }
}
