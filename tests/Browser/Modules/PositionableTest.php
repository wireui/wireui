<?php

namespace Tests\Browser\Modules;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class PositionableTest extends BrowserTestCase
{
    /** @dataProvider components */
    public function test_it_should_open_and_close_the_popover(string $html)
    {
        $this->browse(function (Browser $browser) use ($html) {
            $name = 'testing';

            $this
                ->visitation($browser, $html)
                ->waitForAlpineJs()

                ->togglePopover($name)
                ->assertPopoverIsOpen($name)

                ->togglePopover($name)
                ->assertPopoverIsClosed($name)

                // assert away/outside click
                ->togglePopover($name)
                ->assertPopoverIsOpen($name)
                ->runScript('document.body.click()')
                ->assertPopoverIsClosed($name);
        });
    }

    public function components(): array
    {
        return [
            'ColorPicker' => ['<x-color-picker name="testing" />'],
        ];
    }
}
