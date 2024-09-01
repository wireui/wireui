<?php

namespace WireUi\Components\Errors\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class MultipleTest extends BrowserTestCase
{
    public function test_livewire_render_all_errors_and_render_filtered_errors(): void
    {
        Livewire::test(new class extends Component
        {
            public array $only = [];

            public function mount(): void
            {
                $this->addErrors();
            }

            public function addFilterErrors(): void
            {
                $this->only = ['first', 'second'];

                $this->addErrors();
            }

            private function addErrors(): void
            {
                $this->addError('first', 'first error');
                $this->addError('second', 'second error');
                $this->addError('third', 'third error');
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-errors :only="$only" />
                </div>
                BLADE;
            }
        })
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

    public function test_browser_render_all_errors_and_render_filtered_errors(): void
    {
        Livewire::visit(new class extends Component
        {
            public array $only = [];

            public function mount(): void
            {
                $this->addErrors();
            }

            public function addFilterErrors(): void
            {
                $this->only = ['first', 'second'];

                $this->addErrors();
            }

            private function addErrors(): void
            {
                $this->addError('first', 'first error');
                $this->addError('second', 'second error');
                $this->addError('third', 'third error');
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-errors :only="$only">
                        <x-slot name="footer">
                            <x-button wire:click="addFilterErrors" label="Filter" negative />
                        </x-slot>
                    </x-errors>
                </div>
                BLADE;
            }
        })
            ->assertSee('first error')
            ->assertSee('second error')
            ->assertSee('third error')
            ->press('Filter')
            ->waitTo(function (Browser $browser) {
                return $browser
                    ->assertSee('first error')
                    ->assertSee('second error')
                    ->assertDontSee('third error');
            });
    }
}
