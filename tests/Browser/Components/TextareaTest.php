<?php

namespace Tests\Browser\Components;

use Livewire\Features\SupportTesting\Testable;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class TextareaTest extends BrowserTestCase
{
    public function rowAttributeComponent(): Testable
    {
        return Livewire::test(new class() extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Textarea Livewire Test</h1>

                    // test it_should_see_the_rows_attribute
                    <x-textarea rows="10" wire:model.live="errorless" />
                </div>
                BLADE;
            }
        });
    }

    public function colAttributeComponent(): Testable
    {
        return Livewire::test(new class() extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Textarea Livewire Test</h1>

                    // test it_should_see_the_cols_attribute
                    <x-textarea rows="10" cols="10" wire:model.live="errorless" />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_see_the_rows_attribute(): void
    {
        $this->rowAttributeComponent()
            ->assertSeeHtml('rows="10"');
    }

    public function test_it_should_see_the_cols_attribute(): void
    {
        $this->colAttributeComponent()
            ->assertSeeHtml('cols="10"');
    }

    public function test_cols_should_default_to_auto_attribute(): void
    {
        // rowAttributeComponent doesn't have cols attribute set, thus it should be auto and w-full
        $this->rowAttributeComponent()
            ->assertSeeHtml('cols="auto"');

        $this->rowAttributeComponent()
            ->assertSeeHtml('w-full');
    }
}
