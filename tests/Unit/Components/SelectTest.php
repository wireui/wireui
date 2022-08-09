<?php

namespace Tests\Unit\Components;

use Tests\Unit\UnitTestCase;
use WireUi\View\Components\Select;

class SelectTest extends UnitTestCase
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
            [
                ['value' => '1', 'label' => 'Option 1'],
                ['value' => '2', 'label' => 'Option 2'],
            ],
            $select->optionsToArray()
        );
    }

    /** @test */
    public function it_should_make_the_json_from_primitive_options()
    {
        $options = ['Option 1', 'Option 2'];

        $select = new Select(options: $options);

        $this->assertEquals(
            [
                ['label' => 'Option 1', 'value' => 'Option 1'],
                ['label' => 'Option 2', 'value' => 'Option 2'],
            ],
            $select->optionsToArray()
        );
    }

    /** @test */
    public function it_should_make_the_json_for_array_keys_values()
    {
        $options = ['Option 1', 'Option 2'];

        $select = new Select(options: $options, optionKeyValue: true);

        $this->assertEquals(
            [
                ['label' => 'Option 1', 'value' => 0],
                ['label' => 'Option 2', 'value' => 1],
            ],
            $select->optionsToArray()
        );
    }

    /** @test */
    public function it_should_parse_the_disabled_and_template_and_readonly()
    {
        $options = [
            ['name' => 'Option 1', 'value' => '1', 'disabled' => true],
            ['name' => 'Option 2', 'value' => '2', 'readonly' => true],
            ['name' => 'Option 3', 'value' => '3', 'template' => 'option-template'],
        ];

        $select = new Select(
            optionLabel: 'name',
            optionValue: 'value',
            options: $options
        );

        $this->assertEquals(
            [
                ['value' => '1', 'disabled' => true, 'label' => 'Option 1', 'readonly' => true],
                ['value' => '2', 'readonly' => true, 'label' => 'Option 2'],
                ['value' => '3', 'template' => 'option-template', 'label' => 'Option 3'],
            ],
            $select->optionsToArray()
        );
    }

    /** @test */
    public function it_should_parse_the_description_by_default_key()
    {
        $select = new Select(
            optionLabel: 'name',
            optionValue: 'value',
            options: [
                ['name' => 'WireUI', 'value' => 'wireui', 'description' => 'The wireui is amazing'],
            ]
        );

        $this->assertEquals(
            [
                [
                    'value'       => 'wireui',
                    'description' => 'The wireui is amazing',
                    'label'       => 'WireUI',
                ],
            ],
            $select->optionsToArray()
        );
    }

    /** @test */
    public function it_should_parse_the_description_by_custom_description_key()
    {
        $select = new Select(
            optionLabel: 'name',
            optionValue: 'value',
            optionDescription: 'info',
            options: [
                ['name' => 'WireUI', 'value' => 'wireui', 'info' => 'The wireui is amazing'],
            ]
        );

        $this->assertEquals(
            [
                [
                    'value'       => 'wireui',
                    'label'       => 'WireUI',
                    'description' => 'The wireui is amazing',
                ],
            ],
            $select->optionsToArray()
        );
    }
}
