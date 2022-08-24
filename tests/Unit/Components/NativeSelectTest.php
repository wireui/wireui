<?php

namespace Tests\Unit\Components;

use Tests\Unit\UnitTestCase;
use WireUi\View\Components\NativeSelect;

class NativeSelectTest extends UnitTestCase
{
    /**
     * @test
     * @dataProvider componentConfigProvider
     */
    public function it_should_validate_the_select_config_to_prevent_developers_errors(array $attributes, string $errorMessage)
    {
        $this->expectExceptionMessage($errorMessage);

        new NativeSelect(...$attributes);
    }

    public function componentConfigProvider(): array
    {
        return [
            'option-value and option-label are not set together: missing option-label' => [
                'attributes'   => ['optionValue' => 'id'],
                'errorMessage' => 'The {option-value} and {option-label} attributes must be set together.',
            ],
            'option-value and option-label are not set together: missing option-value' => [
                'attributes'   => ['optionLabel' => 'name'],
                'errorMessage' => 'The {option-value} and {option-label} attributes must be set together.',
            ],
            'flip-options cannot be used with option-value and option-label' => [
                'attributes' => [
                    'optionValue' => 'id',
                    'optionLabel' => 'name',
                    'flipOptions' => true,
                ],
                'errorMessage' => 'The {flip-options} attribute cannot be used with {option-value} and {option-label} attributes.',
            ],
            'only primitive values can be used without a {option-value} and {option-label} attributes' => [
                'attributes' => [
                    'options' => [
                        ['id' => 1, 'name' => 'Option 1'],
                        ['id' => 2, 'name' => 'Option 2'],
                    ],
                ],
                'errorMessage' => 'Inform the {option-value} and {option-label} to use array, model, or object option.'
                    . ' <x-select [...] option-value="id" option-label="name" />',
            ],
            'option-value and option-label cannot be used with primitive options' => [
                'attributes' => [
                    'optionValue' => 'id',
                    'optionLabel' => 'name',
                    'options'     => ['name', 'id', 'email'],
                ],
                'errorMessage' => 'The {option-value} and {option-label} attributes cannot be used with primitive options values: '
                    . implode(', ', NativeSelect::PRIMITIVE_VALUES),
            ],
        ];
    }

    public function test_it_should_allow_using_option_key_value_with_option_label()
    {
        $option = [
            'label'       => 'label',
            'description' => 'description',
        ];

        $component = new NativeSelect(
            optionKeyValue: true,
            optionLabel: 'label',
            options: [
                'value' => $option,
            ]
        );

        $this->assertSame('value', $component->getOptionValue('value', $option));
        $this->assertSame('label - description', $component->getOptionLabel($option));
        $this->assertSame('description', $component->getOptionDescription($option));
    }

    /** @test */
    public function it_should_flip_the_component_options_when_the_flip_options_is_true()
    {
        $component = new NativeSelect(
            flipOptions: true,
            options: [
                'A' => 'Option 1',
                'B' => 'Option 2',
            ]
        );

        $this->assertEquals(
            [
                'Option 1' => 'A',
                'Option 2' => 'B',
            ],
            $component->options->toArray()
        );
    }

    /** @test */
    public function it_should_get_the_key_as_value_when_the_option_key_value_is_true()
    {
        $component = new NativeSelect(
            optionKeyValue: true,
            options: [
                'A' => 'Option 1',
                'B' => 'Option 2',
            ]
        );

        $this->assertEquals('A', $component->getOptionValue('A', $component->options->first()));
    }

    /** @test */
    public function it_should_get_the_option_value_without_an_option_value_attribute()
    {
        $component = new NativeSelect(
            optionKeyValue: false,
            options: [
                'A' => 'Option 1',
                'B' => 'Option 2',
            ]
        );

        $this->assertEquals('Option 1', $component->getOptionValue('A', $component->options->first()));
    }

    /** @test */
    public function it_should_get_the_option_value_using_the_option_value_attribute()
    {
        $component = new NativeSelect(
            optionValue: 'id',
            optionLabel: 'name',
            options: [
                ['id' => 1, 'name' => 'Option 1'],
                ['id' => 2, 'name' => 'Option 2'],
            ]
        );

        $this->assertEquals(1, $component->getOptionValue(0, $component->options->first()));
    }

    /** @test */
    public function it_should_get_the_label_without_option_label()
    {
        $component = new NativeSelect(
            options: [
                'A' => 'Option 1',
                'B' => 'Option 2',
            ]
        );

        $this->assertEquals('Option 1', $component->getOptionLabel($component->options->first()));
    }

    /** @test */
    public function it_should_get_the_label_with_option_label()
    {
        $component = new NativeSelect(
            optionValue: 'id',
            optionLabel: 'name',
            options: [
                ['id' => 1, 'name' => 'Option 1'],
                ['id' => 2, 'name' => 'Option 2'],
            ]
        );

        $this->assertEquals('Option 1', $component->getOptionLabel($component->options->first()));
    }
}
