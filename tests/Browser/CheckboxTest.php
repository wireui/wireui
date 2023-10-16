<?php

namespace Tests\Browser;

use Livewire\{Attributes\Rule, Component, Livewire};

class CheckboxTest extends BrowserTestCase
{
    /** @test */
    public function it_should_render_with_label_and_change_value()
    {
        Livewire::visit(new class() extends Component
        {
            #[Rule('accepted')]
            public bool $checkbox = false;

            protected array $messages = [
                'checkbox.accepted' => 'accept it',
            ];

            public function validateCheckbox()
            {
                $this->validate();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Checkbox Test</h1>

                    <span dusk="checkbox">@json($checkbox)</span>

                    // test it_should_render_with_label_and_change_value
                    <x-checkbox label="Remember me" wire:model.live="checkbox" />

                    <button wire:click="validateCheckbox" dusk="validate">validate</button>
                </div>
                BLADE;
            }
        })
            ->assertSee('Remember me')
            ->check('checkbox')
            ->assertChecked('checkbox')
            ->waitForTextIn('@checkbox', 'true')
            ->uncheck('checkbox')
            ->assertNotChecked('checkbox')
            ->waitForTextIn('@checkbox', 'false')
            ->click('@validate')
            ->waitForText('accept it');
    }
}
