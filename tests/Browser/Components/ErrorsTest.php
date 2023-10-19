<?php

namespace Tests\Browser\Components;

use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class ErrorsTest extends BrowserTestCase
{
    public function test_it_should_render_all_errors_and_render_filtered_errors()
    {
        Livewire::visit(new class() extends Component
        {
            public array $only = [];

            protected $listeners = ['showDialog', 'addEvent'];

            public function addErrors()
            {
                $this->addError('first', 'first error');
                $this->addError('second', 'second error');
                $this->addError('third', 'third error');
            }

            public function addFilterErrors(string $event)
            {
                $this->only = ['first', 'second'];

                $this->addErrors();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Errors test</h1>

                    <x-errors :only="$only" />
                </div>
                BLADE;
            }
        })
            ->call('addErrors')
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
