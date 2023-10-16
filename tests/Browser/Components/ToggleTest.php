<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class ToggleTest extends BrowserTestCase
{
    public function test_it_should_render_label_and_change_value()
    {
        Livewire::visit(new class() extends Component
        {
            public $toggle = false;

            protected $rules = ['toggle' => 'accepted'];

            protected $messages = ['toggle.accepted' => 'accept it'];

            public function validateToggle()
            {
                $this->validate();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Toggle test</h1>

                    <span dusk="toggle">@json($toggle)</span>

                    // test it_should_render_label_and_change_value
                    <x-toggle label="Enable Notifications" wire:model.live="toggle" />

                    <button wire:click="validateToggle" dusk="validate">validate</button>
                </div>
                BLADE;
            }
        })
            ->assertSee('Enable Notifications')
            ->tap(fn (Browser $browser) => $browser->script("document.getElementById('toggle').click()"))
            ->assertChecked('toggle')
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@toggle', 'true'))
            ->tap(fn (Browser $browser) => $browser->script("document.getElementById('toggle').click()"))
            ->assertNotChecked('toggle')
            ->click('@validate')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('accept it'));
    }
}
