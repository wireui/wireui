<?php

namespace WireUi\Components\Modal\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class IndexTest extends BrowserTestCase
{
    public function test_modal_component_with_alpine(): void
    {
        Livewire::visit(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-button label="Open" x-on:click="$openModal('modal')" />

                        <x-modal name="modal">
                            <x-card title="Modal Title">
                                <x-button label="Close" x-on:click="$closeModal('modal')" />
                            </x-card>
                        </x-modal>
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertDontSee('Modal Title')
            ->press('Open')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Modal Title'))
            ->press('Close')
            ->waitTo(fn (Browser $browser) => $browser->assertDontSee('Modal Title'));
    }

    public function test_modal_component_with_livewire(): void
    {
        Livewire::visit(new class extends Component
        {
            public bool $show = false;

            public function open(): void
            {
                $this->show = true;
            }

            public function close(): void
            {
                $this->show = false;
            }

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-badge dusk="show" :label="json_encode($show)" />

                        <x-button label="Open" wire:click="open" />

                        <x-modal wire:model="show">
                            <x-card title="Modal Title">
                                <x-button label="Close" wire:click="close" />
                            </x-card>
                        </x-modal>
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertDontSee('Modal Title')
            ->assertSeeIn('@show', 'false')
            ->press('Open')
            ->waitForTextIn('@show', 'true')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Modal Title'))
            ->press('Close')
            ->waitForTextIn('@show', 'false')
            ->waitTo(fn (Browser $browser) => $browser->assertDontSee('Modal Title'));
    }
}
