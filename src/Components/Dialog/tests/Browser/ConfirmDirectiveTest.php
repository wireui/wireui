<?php

namespace WireUi\Components\Dialog\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class ConfirmDirectiveTest extends BrowserTestCase
{
    public function test_it_should_call_confirm_notification_by_directive_with_alpine_js(): void
    {
        Livewire::visit(new class extends Component
        {
            public string $value = '';

            public function setValue(string $value): void
            {
                $this->value = $value;
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$value" />

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
                </div>
                BLADE;
            }
        })
            ->click('@button.alpine')
            ->waitForText('Alpine Confirmation')
            ->waitForText('AcceptAlpine')
            ->press('AcceptAlpine')
            ->waitForTextIn('@value', 'Accepted by Alpine');
    }

    public function test_it_should_call_confirm_notification_by_directive_js(): void
    {
        Livewire::visit(new class extends Component
        {
            public string $value = '';

            public function setValue(string $value): void
            {
                $this->value = $value;
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$value" />

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
        })
            ->click('@button.js')
            ->waitForText('JS Confirmation')
            ->waitForText('AcceptJS')
            ->press('AcceptJS')
            ->waitForTextIn('@value', 'Accepted by JS');
    }
}
