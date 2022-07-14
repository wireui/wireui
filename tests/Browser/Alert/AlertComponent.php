<?php

namespace Tests\Browser\Alert;

class AlertComponent extends \Livewire\Component
{
    public function render(): string
    {
        return <<<BLADE
        <div>
            <h1>Alert test</h1>

            <x-alert heading="This is heading" text="This is the text" />

            <x-alert info dismiss heading="This is heading" text="This is the text" />
            <x-alert info border heading="This is heading" text="This is the text" />
            <x-alert info shadow heading="This is heading" text="This is the text" />
            <x-alert info heading="This is heading" text="This is the text" icon="information-circle" />

            <x-alert warning dismiss heading="This is heading" text="This is the text" />
            <x-alert warning border heading="This is heading" text="This is the text" />
            <x-alert warning shadow heading="This is heading" text="This is the text" />
            <x-alert warning heading="This is heading" text="This is the text" icon="exclamation" />

            <x-alert success dismiss heading="This is heading" text="This is the text" />
            <x-alert success border heading="This is heading" text="This is the text" />
            <x-alert success shadow heading="This is heading" text="This is the text" />
            <x-alert success heading="This is heading" text="This is the text" icon="information-circle" />

            <x-alert danger dismiss heading="This is heading" text="This is the text" />
            <x-alert danger border heading="This is heading" text="This is the text" />
            <x-alert danger shadow heading="This is heading" text="This is the text" />
            <x-alert danger heading="This is heading" text="This is the text" icon="x-circle" />
        </div>
        BLADE;
    }
}
