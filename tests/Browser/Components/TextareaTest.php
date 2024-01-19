<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\Features\SupportTesting\Testable;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class TextareaTest extends BrowserTestCase
{
    public function browser(): Browser
    {
        return Livewire::visit(new class () extends Component {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Textarea Browser Test</h1>

                    // test it_should_set_model_value_to_livewire
                    <x-textarea dusk="textarea" wire:model.live="model" label="Model Textarea" />

                    <span dusk="model-value">{{ $model }}</span>
                </div>
                BLADE;
            }
        });
    }

    public function component(): Testable
    {
        return Livewire::test(new class () extends Component {
            public $model = null;

            public function validateTextarea()
            {
                $this->validate();
            }

            public function resetTextareaValidation()
            {
                $this->resetValidation();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Textarea Livewire Test</h1>

                    // test it_should_see_the_rows_attribute
                    <x-textarea rows="10" cols="auto" wire:model.live="errorless" />

                    // test it_should_see_the_cols_attribute
                    <x-textarea rows="10" cols="10" wire:model.live="errorless" />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_see_the_rows_attribute(): void
    {
        $this->component()
            ->assertSeeHtml('rows="10"');
    }

    public function test_it_should_see_the_cols_attribute(): void
    {
        $this->component()
            ->assertSeeHtml('cols="10"');

    }

    public function test_cols_should_default_to_auto_attribute(): void
    {
        $this->component()
            ->assertSeeHtml('cols="auto"');

        $this->component()
            ->assertSeeHtml('w-full');
    }
}
