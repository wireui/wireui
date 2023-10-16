<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};

class ConfirmDirective extends BrowserTestCase
{
    public function component(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public string $value = '';

            protected array $messages = [
                'checkbox.accepted' => 'accept it',
            ];

            public function setValue(string $value): void
            {
                $this->value = $value;
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Confirm Directive test</h1>

                    <span dusk="value">{{ $value }}</span>

                    <div x-data="{ title: 'Alpine Confirmation' }">
                        <x-button
                            dusk="button.alpine"
                            label="With Alpine"
                            x-on:confirm="{
                                title,
                                icon: 'info',
                                method: 'setValue',
                                params: 'Accepted by Alpine',
                                accept: { label: 'AcceptAlpine' }
                            }"
                        />
                    </div>

                    <x-button
                        dusk="button.js"
                        label="JS"
                        x-on:confirm="{
                            title: 'JS Confirmation',
                            icon: 'info',
                            method: 'setValue',
                            params: 'Accepted by JS',
                            accept: { label: 'AcceptJS' }
                        }"
                    />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_call_confirm_notification_by_directive_with_alpine_js()
    {
        $this->component()
            ->click('@button.alpine')
            ->waitForText('Alpine Confirmation')
            ->waitForText('AcceptAlpine')
            ->press('AcceptAlpine')
            ->waitForTextIn('@value', 'Accepted by Alpine');
    }

    /** @test */
    public function it_should_call_confirm_notification_by_directive_js()
    {
        $this->component()
            ->click('@button.js')
            ->waitForText('JS Confirmation')
            ->waitForText('AcceptJS')
            ->press('AcceptJS')
            ->waitForTextIn('@value', 'Accepted by JS');
    }
}
