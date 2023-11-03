<?php

namespace Tests\Browser\Components\Modules;

use Tests\Browser\BrowserTestCase;

class PositionableTest extends BrowserTestCase
{
    /** @dataProvider components */
    public function test_it_should_open_and_close_the_popover(string $html)
    {
        $name = 'testing';

        $this->render($html)
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
    }

    public static function components(): array
    {
        return [
            'ColorPicker' => ['<x-color-picker name="testing" />'],
        ];
    }
}
