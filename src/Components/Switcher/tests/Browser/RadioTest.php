<?php

namespace WireUi\Components\Switcher\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class RadioTest extends BrowserTestCase
{
    public function browser(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $radio = null;

            protected $rules = ['radio' => 'required'];

            protected $messages = ['radio.required' => 'select one'];

            public function validateRadio()
            {
                $this->validate();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Radio Browser Test</h1>

                    <span dusk="radio">@json($radio)</span>

                    // test it_should_render_with_label_and_change_value
                    <x-radio id="laravel"  value="Laravel"  label="Laravel"  wire:model.live="radio" />
                    <x-radio id="livewire" value="Livewire" label="Livewire" wire:model.live="radio" />

                    <button wire:click="validateRadio" dusk="validate">validate</button>
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_render_with_label_and_change_value(): void
    {
        $this->browser()
            ->assertSee('Laravel')
            ->assertSee('Livewire')
            ->click('@validate')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('select one'))
            ->radio('radio', 'Laravel')
            ->assertRadioSelected('radio', 'Laravel')
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@radio', 'Laravel'))
            ->radio('radio', 'Livewire')
            ->assertRadioSelected('radio', 'Livewire')
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@radio', 'Livewire'));
    }
}
