<?php

namespace WireUi\Components\TextField\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class TextareaTest extends BrowserTestCase
{
    public function test_it_should_see_the_rows_attribute(): void
    {
        Livewire::test(new class extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-textarea wire:model.live="model" rows="10" />
                </div>
                BLADE;
            }
        })
            ->assertSeeHtml('rows="10"');
    }

    public function test_it_should_see_the_cols_attribute(): void
    {
        Livewire::test(new class extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-textarea wire:model.live="model" rows="10" cols="10" />
                </div>
                BLADE;
            }
        })
            ->assertSeeHtml('cols="10"');
    }

    public function test_cols_should_default_to_auto_attribute(): void
    {
        // rowAttributeComponent doesn't have cols attribute set, thus it should be auto and w-full
        Livewire::test(new class extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-textarea wire:model.live="model" rows="10" />
                </div>
                BLADE;
            }
        })
            ->assertSeeHtml('cols="auto"');

        Livewire::test(new class extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-textarea wire:model.live="model" rows="10" />
                </div>
                BLADE;
            }
        })
            ->assertSeeHtml('w-full');
    }
}
