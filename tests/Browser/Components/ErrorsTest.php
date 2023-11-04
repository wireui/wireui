<?php

namespace Tests\Browser\Components;

use Livewire\Features\SupportTesting\Testable;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class ErrorsTest extends BrowserTestCase
{
    public function component(): Testable
    {
        return Livewire::test(new class() extends Component
        {
            public array $only = [];

            public function mount()
            {
                $this->addErrors();
            }

            public function addFilterErrors()
            {
                $this->only = ['first', 'second'];

                $this->addErrors();
            }

            private function addErrors()
            {
                $this->addError('first', 'first error');
                $this->addError('second', 'second error');
                $this->addError('third', 'third error');
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Errors Livewire Test</h1>

                    <x-errors :only="$only" />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_render_all_errors_and_render_filtered_errors(): void
    {
        $this->component()
            ->assertSee('first error')
            ->assertSee('second error')
            ->assertSee('third error')
            ->assertHasErrors(['first', 'second', 'third'])
            ->call('addFilterErrors')
            ->assertSee('first error')
            ->assertSee('second error')
            ->assertDontSee('third error')
            ->assertHasErrors(['first', 'second', 'third']);
    }
}
