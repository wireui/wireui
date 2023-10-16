<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};

class ColorPickerTest extends BrowserTestCase
{
    public const HTML = '<x-color-picker label="Color Picker" name="color" />';
    public const NAME = 'color';

    public function test_it_should_select_a_color()
    {
        $this->render(self::HTML)
            ->openPopover(self::NAME)
            ->selectColorByTitle(self::NAME, 'White')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue(self::NAME, '#fff'))

            ->openPopover(self::NAME)
            ->selectColorByTitle(self::NAME, 'Black')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue(self::NAME, '#000'))

            ->openPopover(self::NAME)
            ->selectColorByTitle(self::NAME, 'purple-100')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue(self::NAME, '#f3e8ff'));
    }

    public function test_it_should_type_the_color_value()
    {
        $this->render(self::HTML)
            ->clear(self::NAME)
            ->assertInputValue(self::NAME, null)
            ->type(self::NAME, 'ABC')
            ->assertInputValue(self::NAME, '#ABC')
            ->type(self::NAME, '123456789')
            ->assertInputValue(self::NAME, '#123456');
    }

    public function test_it_should_auto_fill_the_color_from_input_element_value_as_color_title()
    {
        $this->render('<x-color-picker color-name-as-value name="color" value="Black" />')
            ->waitForAlpineJs()
            ->assertInputValue('color', 'Black');
    }

    public function test_auto_fill_from_wire_model()
    {
        Livewire::visit(new class() extends Component
        {
            public ?string $color = '#FFF';

            public function render(): string
            {
                return '<x-color-picker wire:model="color" />';
            }
        })
            ->waitForAlpineJs()
            ->assertInputValue('color', '#FFF');
    }

    public function test_wire_model_defer()
    {
        Livewire::visit(new class() extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <button dusk="refresh" wire:click="$refresh">Refresh</button>
                        <button dusk="value">{{ $color }}</button>

                        <x-color-picker wire:model="color" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()

            ->typeSlowly('color', 'FFF')
            ->assertInputValue('color', '#FFF')
            ->pause(400)
            ->assertSeeNothingIn('@value')

            ->typeSlowly('color', '000')
            ->assertInputValue('color', '#000')
            ->pause(400)
            ->assertSeeNothingIn('@value')

            ->click('@refresh')
            ->waitForTextIn('@value', '#000');
    }

    public function test_wire_model_live()
    {
        Livewire::visit(new class() extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <button dusk="value">{{ $color }}</button>

                        <x-color-picker name="color" wire:model.live="color" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()

            ->typeSlowly('color', 'FFF')
            ->assertInputValue('color', '#FFF')
            ->waitForTextIn('@value', '#FFF')

            ->typeSlowly('color', '000')
            ->assertInputValue('color', '#000')
            ->waitForTextIn('@value', '#000');
    }

    public function test_wire_model_live_blur()
    {
        Livewire::visit(new class() extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <button dusk="outside">Outside</button>
                        <button dusk="value">{{ $color }}</button>

                        <x-color-picker name="color" wire:model.live.blur="color" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()

            ->typeSlowly('color', 'FFF')
            ->assertInputValue('color', '#FFF')
            ->assertSeeNothingIn('@value')

            ->click('@outside')
            ->waitForTextIn('@value', '#FFF');
    }

    public function test_wire_model_debounce()
    {
        Livewire::visit(new class() extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <button dusk="value">{{ $color }}</button>

                        <x-color-picker name="color" wire:model.live.debounce.300ms="color" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()

            ->typeSlowly('color', 'FFF')
            ->assertInputValue('color', '#FFF')
            ->assertSeeNothingIn('@value')
            ->pause(400)
            ->assertSeeIn('@value', '#FFF')

            ->typeSlowly('color', '000')
            ->assertInputValue('color', '#000')
            ->assertSeeIn('@value', '#FFF')
            ->pause(400)
            ->assertSeeIn('@value', '#000');
    }

    public function test_wire_model_throttle()
    {
        Livewire::visit(new class() extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <button dusk="value">{{ $color }}</button>

                        <x-color-picker name="color" wire:model.live.throttle.500ms="color" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()

            ->typeSlowly('color', 'FFF', 40)
            ->assertInputValue('color', '#FFF')
            ->assertSeeIn('@value', '#F')
            ->pause(500)
            ->assertSeeIn('@value', '#FFF')

            ->typeSlowly('color', 'FFFF', 40)
            ->assertInputValue('color', '#FFFF')
            ->pause(500)
            ->assertSeeIn('@value', '#FFFF');
    }
}
