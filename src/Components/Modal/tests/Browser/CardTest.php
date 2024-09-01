<?php

namespace WireUi\Components\Modal\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class CardTest extends BrowserTestCase
{
    public function test_modal_card_component(): void
    {
        Livewire::visit(new class extends Component
        {
            public bool $hideClose = false;

            #[On('toggle-close')]
            public function toggleClose(): void
            {
                $this->hideClose = ! $this->hideClose;
            }

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-button label="Open" x-on:click="$openModal('modalCard')" />

                        <x-modal-card title="Modal Card Title" name="modalCard" :hide-close="$hideClose" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertDontSee('Modal Card Title')
            ->press('Open')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Modal Card Title'))
            ->assertPresent('div:not([class]) > button[x-on\\:click="close"')
            ->tap(fn (Browser $browser) => $browser->script(<<<'JS'
                window.Livewire.dispatch('toggle-close')
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertNotPresent('div:not([class]) > button[x-on\\:click="close"'))
            ->tap(fn (Browser $browser) => $browser->script(<<<'JS'
                window.Livewire.dispatch('toggle-close')
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertPresent('div:not([class]) > button[x-on\\:click="close"'))
            ->click('div:not([class]) > button[x-on\\:click="close"')
            ->waitTo(fn (Browser $browser) => $browser->assertDontSee('Modal Card Title'));
    }
}
