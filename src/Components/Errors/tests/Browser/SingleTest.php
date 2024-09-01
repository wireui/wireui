<?php

namespace WireUi\Components\Errors\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class SingleTest extends BrowserTestCase
{
    public function test_livewire_render_error(): void
    {
        Livewire::test(new class extends Component
        {
            public bool $validation = true;

            public function mount(): void
            {
                $this->addError('test', 'test error');
            }

            public function resetError(): void
            {
                $this->validation = false;
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-error name="test" :validation="$validation" />
                </div>
                BLADE;
            }
        })
            ->assertSee('test error')
            ->assertHasErrors(['test'])
            ->call('resetError')
            ->assertDontSee('test error')
            ->assertHasNoErrors(['test']);
    }

    public function test_browser_render_error(): void
    {
        Livewire::visit(new class extends Component
        {
            public bool $validation = true;

            public function mount(): void
            {
                $this->addError('test', 'test error');
            }

            public function resetError(): void
            {
                $this->validation = false;
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-error name="test" :validation="$validation" />

                    <x-button wire:click="resetError" label="Reset" negative />
                </div>
                BLADE;
            }
        })
            ->assertSee('test error')
            ->press('Reset')
            ->waitTo(function (Browser $browser) {
                return $browser->assertDontSee('test error');
            });
    }
}
