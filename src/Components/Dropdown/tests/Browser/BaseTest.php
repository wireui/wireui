<?php

namespace WireUi\Components\Dropdown\tests\Browser;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class BaseTest extends BrowserTestCase
{
    public const HTML = <<<'BLADE'
    <x-button dusk="outside" label="Outside" />

    <x-dropdown label="Color Picker">
        <x-slot:trigger>
            <x-button dusk="toggle" label="Click me" />
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
            ->waitTo(fn (Browser $browser) => $browser->assertSee('White'))
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Black'))
            ->waitTo(fn (Browser $browser) => $browser->assertSee('purple-100'));
    }

    public function test_dropdown_should_close_when_click_outside(): void
    {
        $this->render(self::HTML)
            ->waitForAlpineJs()
            ->click('@toggle')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('White'))
            ->click('@outside')
            ->waitTo(fn (Browser $browser) => $browser->assertDontSee('White'));
    }
}
