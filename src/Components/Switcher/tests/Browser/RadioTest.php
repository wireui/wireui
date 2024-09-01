<?php

namespace WireUi\Components\Switcher\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class RadioTest extends BrowserTestCase
{
    public function test_radio_component(): void
    {
        Livewire::visit(new class extends Component
        {
            #[Validate('required', message: 'select one')]
            public mixed $radio = null;

            public function save(): void
            {
                $this->validate();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="radio" :label="json_encode($radio)" />

                    <x-radio id="laravel" wire:model.live="radio" value="Laravel"  label="Laravel" />

                    <x-radio id="livewire" wire:model.live="radio" value="Livewire" label="Livewire" />

                    <x-button dusk="validate" wire:click="save" label="Save" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Laravel')
            ->assertSee('Livewire')
            ->click('@validate')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('select one'))
            ->radio('radio', 'Laravel')
            ->assertRadioSelected('radio', 'Laravel')
            ->waitForTextIn('@radio', 'Laravel')
            ->radio('radio', 'Livewire')
            ->assertRadioSelected('radio', 'Livewire')
            ->waitForTextIn('@radio', 'Livewire');
    }
}
