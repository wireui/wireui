<?php

namespace WireUi\Components\Dropdown\tests\Browser;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class HeaderTest extends BrowserTestCase
{
    public const HTML = <<<BLADE
    <x-wui:button dusk="outside" label="Outside" />

    <x-wui:dropdown label="Color Picker">
        <x-slot:trigger>
            <x-wui:button dusk="toggle" label="Click me" />
        </x-slot:trigger>

        <x-wui:dropdown.header label="Header">
            <x-wui:dropdown.item label="Item 1" />
            <x-wui:dropdown.item label="Item 2" />
        </x-wui:dropdown.header>
    </x-wui:dropdown>
    BLADE;

    public function test_it_should_open_the_dropdown_with_header(): void
    {
        $this->render(self::HTML)
            ->waitForAlpineJs()
            ->click('@toggle')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Header'))
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Item 1'))
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Item 2'));
    }

    public function test_dropdown_should_close_when_click_outside(): void
    {
        $this->render(self::HTML)
            ->waitForAlpineJs()
            ->click('@toggle')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Header'))
            ->click('@outside')
            ->waitTo(fn (Browser $browser) => $browser->assertDontSee('Header'));
    }
}
