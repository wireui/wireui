<?php

namespace WireUi\Components\Dropdown\tests\Browser;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class BaseTest extends BrowserTestCase
{
    public const HTML = <<<BLADE
    <x-wui:button dusk="outside" label="Outside" />

    <x-wui:dropdown label="Color Picker">
        <x-slot:trigger>
            <x-wui:button dusk="toggle" label="Click me" />
        </x-slot:trigger>

        <x-wui:dropdown.item label="White" />
        <x-wui:dropdown.item label="Black" />
        <x-wui:dropdown.item label="purple-100" />
    </x-wui:dropdown>
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
