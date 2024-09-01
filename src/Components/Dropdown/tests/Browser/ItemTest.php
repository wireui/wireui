<?php

namespace WireUi\Components\Dropdown\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class ItemTest extends BrowserTestCase
{
    public function test_it_should_click_in_dropdown_items(): void
    {
        Livewire::visit(new class extends Component
        {
            public string $item = '';

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="item" :label="$item" />

                    <x-dropdown label="Color Picker">
                        <x-slot:trigger>
                            <x-button dusk="toggle" label="Click me" />
                        </x-slot:trigger>

                        <x-dropdown.item dusk="item1" x-on:click.prevent="$wire.set('item', 1)" label="Item 1" />
                        <x-dropdown.item dusk="item2" x-on:click.prevent="$wire.set('item', 2)" label="Item 2" />
                        <x-dropdown.item dusk="item3" x-on:click.prevent="$wire.set('item', 3)" label="Item 3" />
                    </x-dropdown>
                </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->click('@toggle')
            ->waitForTextIn('@item1', 'Item 1')
            ->click('@item1')->waitForTextIn('@item', '1')
            ->click('@toggle')
            ->waitForTextIn('@item2', 'Item 2')
            ->click('@item2')->waitForTextIn('@item', '2')
            ->click('@toggle')
            ->waitForTextIn('@item3', 'Item 3')
            ->click('@item3')->waitForTextIn('@item', '3');
    }
}
