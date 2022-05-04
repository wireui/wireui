<?php

namespace Tests\Unit\Components;

use Orchestra\Testbench\TestCase;
use WireUi\View\Components\Select;

class SelectTest extends TestCase
{
    /** @test */
    public function It_should_throw_an_error_if_async_data_and_options_is_set_together()
    {
        $this->expectErrorMessage('The {async-data} attribute cannot be used with {options} attribute.');

        new Select(asyncData: 'http://example.com/api/options', options: ['name' => 'Option 1']);
    }

    /** @test */
    public function it_should_make_the_mapped_json_from_the_options()
    {
        $options = [
            ['name' => 'Option 1', 'value' => '1'],
            ['name' => 'Option 2', 'value' => '2'],
        ];

        $select = new Select(
            optionLabel: 'name',
            optionValue: 'value',
            options: $options
        );

        $this->assertEquals(
            json_encode([
                ['name' => 'Option 1', 'value' => '1', 'label' => 'Option 1'],
                ['name' => 'Option 2', 'value' => '2', 'label' => 'Option 2'],
            ]),
            $select->optionsToJson()
        );
    }

    /** @test */
    public function it_should_make_the_json_from_primitive_options()
    {
        $options = ['Option 1', 'Option 2'];

        $select = new Select(options: $options);

        $this->assertEquals(
            json_encode([
                ['label' => 'Option 1', 'value' => 'Option 1'],
                ['label' => 'Option 2', 'value' => 'Option 2'],
            ]),
            $select->optionsToJson()
        );
    }

    /** @test */
    public function it_should_parse_the_disabled_and_template_and_readonly()
    {
        $options = [
            ['name' => 'Option 1', 'value' => '1', 'disabled' => true],
            ['name' => 'Option 2', 'value' => '2', 'readonly' => true],
            ['name' => 'Option 2', 'value' => '2', 'template' => 'option-template'],
        ];

        $select = new Select(
            optionLabel: 'name',
            optionValue: 'value',
            options: $options
        );

        $this->assertEquals(
            json_encode([
                ['name' => 'Option 1', 'value' => '1', 'disabled' => true, 'label' => 'Option 1', 'readonly' => true],
                ['name' => 'Option 2', 'value' => '2', 'readonly' => true, 'label' => 'Option 2'],
                ['name' => 'Option 2', 'value' => '2', 'template' => 'option-template', 'label' => 'Option 2'],
            ]),
            $select->optionsToJson()
        );
    }
}
