<?php

namespace Tests\Browser\Components\Modules\Entangleable;

use Tests\Browser\BrowserTestCase;

class SupportsAlpineTest extends BrowserTestCase
{
    public static function componentsInXData(): array
    {
        return [
            'ColorPicker' => [
                'html' => <<<'BLADE'
                    <div x-data="{ color: '#000' }">
                        <x-color-picker label="Color Picker" name="value" x-modelable="color" />
                    </div>
                BLADE,
                'value' => '#000',
            ],
        ];
    }

    /** @dataProvider componentsInXData */
    public function test_it_should_auto_fill_the_value_from_x_modelable_attribute(
        string $html,
        string|int $value,
    ) {
        $this->render($html)
            ->waitForAlpineJs()
            ->assertInputValue('value', $value);
    }

    public static function components(): array
    {
        return [
            'ColorPicker' => [
                'html' => '<x-color-picker label="Color Picker" name="value" value="#000" />',
                'value' => '#000',
            ],
        ];
    }

    /** @dataProvider components */
    public function test_it_should_auto_fill_the_value_from_input_element_value_attribute(
        string $html,
        string|int $value,
    ) {
        $this->render($html)
            ->waitForAlpineJs()
            ->assertInputValue('value', $value);
    }
}
