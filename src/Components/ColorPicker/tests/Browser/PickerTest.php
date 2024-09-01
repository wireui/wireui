<?php

namespace WireUi\Components\ColorPicker\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class PickerTest extends BrowserTestCase
{
    public const NAME = 'color';

    public const HTML = <<<'BLADE'
        <x-color-picker label="Color Picker" name="color" />
    BLADE;

    public function test_it_should_select_a_color(): void
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

    public function test_it_should_type_the_color_value(): void
    {
        $this->render(self::HTML)
            ->clear(self::NAME)
            ->assertInputValue(self::NAME, null)
            ->type(self::NAME, 'ABC')
            ->assertInputValue(self::NAME, '#ABC')
            ->type(self::NAME, '123456789')
            ->assertInputValue(self::NAME, '#123456');
    }

    public function test_it_should_auto_fill_the_color_from_input_element_value_as_color_title(): void
    {
        $this->render(<<<'BLADE'
            <x-color-picker color-name-as-value name="color" value="Black" />
        BLADE)
            ->waitForAlpineJs()
            ->assertInputValue('color', 'Black');
    }

    public function test_auto_fill_from_wire_model(): void
    {
        Livewire::visit(new class extends Component
        {
            public ?string $color = '#FFF';

            public function render(): string
            {
                return <<<'BLADE'
                    <x-color-picker wire:model="color" />
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->assertInputValue('color', '#FFF');
    }

    public function test_wire_model_defer(): void
    {
        Livewire::visit(new class extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-button dusk="refresh" wire:click="$refresh" label="Refresh" />

                        <x-button dusk="value" :label="$color" />

                        <x-color-picker wire:model="color" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->typeSlowly('color', 'FFF')
            ->assertInputValue('color', '#FFF')
            ->pause(500)
            ->assertSeeNothingIn('@value')
            ->typeSlowly('color', '000')
            ->assertInputValue('color', '#000')
            ->pause(500)
            ->assertSeeNothingIn('@value')
            ->click('@refresh')
            ->waitForTextIn('@value', '#000');
    }

    public function test_wire_model_live(): void
    {
        Livewire::visit(new class extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-button dusk="value" :label="$color" />

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

    public function test_wire_model_live_blur(): void
    {
        Livewire::visit(new class extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-button dusk="outside" label="Outside" />

                        <x-button dusk="value" :label="$color" />

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

    public function test_wire_model_debounce(): void
    {
        Livewire::visit(new class extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-button dusk="value" :label="$color" />

                        <x-color-picker name="color" wire:model.live.debounce.300ms="color" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->typeSlowly('color', 'FFF')
            ->assertInputValue('color', '#FFF')
            ->assertSeeNothingIn('@value')
            ->pause(500)
            ->waitForTextIn('@value', '#FFF')
            ->typeSlowly('color', '000')
            ->assertInputValue('color', '#000')
            ->waitForTextIn('@value', '#FFF')
            ->pause(500)
            ->waitForTextIn('@value', '#000');
    }

    public function test_wire_model_throttle(): void
    {
        Livewire::visit(new class extends Component
        {
            public ?string $color = null;

            public function render(): string
            {
                return <<<'BLADE'
                    <div>
                        <x-button dusk="value" :label="$color" />

                        <x-color-picker name="color" wire:model.live.throttle.500ms="color" />
                    </div>
                BLADE;
            }
        })
            ->waitForAlpineJs()
            ->typeSlowly('color', 'FFF', 40)
            ->assertInputValue('color', '#FFF')
            ->waitForTextIn('@value', '#F')
            ->pause(500)
            ->waitForTextIn('@value', '#FFF')
            ->typeSlowly('color', 'FFFF', 40)
            ->assertInputValue('color', '#FFFF')
            ->pause(500)
            ->waitForTextIn('@value', '#FFFF');
    }
}
