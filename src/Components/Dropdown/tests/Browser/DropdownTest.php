<?php

namespace WireUi\Components\Dropdown\tests\Browser;

use Tests\Browser\BrowserTestCase;

class DropdownTest extends BrowserTestCase
{
    public const HTML = <<<BLADE
    <button dusk="outside">Outside</button>

    <x-dropdown label="Color Picker">
        <x-slot:trigger>
            <button dusk="toggle">Click me</button>
        </x-slot:trigger>

        <x-dropdown.item label="White" />
        <x-dropdown.item label="Black" />
        <x-dropdown.item label="purple-100" />
    </x-dropdown>
    BLADE;

    public function test_it_should_open_the_dropdown(): void
    {
        $this->render(self::HTML)
            ->waitForAlpineJs()
            ->click('@toggle')
            ->waitForText('White')
            ->assertSee('White')
            ->assertSee('Black')
            ->assertSee('purple-100');
    }

    public function test_dropdown_should_close_when_click_outside(): void
    {
        $this->render(self::HTML)
            ->waitForAlpineJs()
            ->click('@toggle')
            ->waitForText('White')
            ->assertSee('White')
            ->click('@outside')
            ->waitUntilMissingText('White')
            ->assertDontSee('White');
    }
}
