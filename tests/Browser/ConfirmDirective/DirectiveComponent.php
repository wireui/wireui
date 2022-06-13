<?php

namespace Tests\Browser\ConfirmDirective;

class DirectiveComponent extends \Livewire\Component
{
    public string $value = '';

    public function render()
    {
        return <<<BLADE
        <div>
            <h1>Confirm Directive test</h1>

            <span dusk="value">{{ \$value }}</span>

            // test it_should_call_confirm_notification_by_directive_with_alpine_js
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

            // test it_should_call_confirm_notification_by_directive_js
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

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
