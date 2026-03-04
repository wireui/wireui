<?php

namespace Tests\Unit\Components;

use WireUi\View\Components\NativeSelect;

it('should validate the select config to prevent developers errors', function (
    array $attributes,
    string $errorMessage,
) {
    $this->expectExceptionMessage($errorMessage);

    new NativeSelect(...$attributes);
})->with([
    'option-value and option-label are not set together: missing option-label' => [
        ['optionValue' => 'id'],
        'The {option-value} and {option-label} attributes must be set together.',
    ],
    'option-value and option-label are not set together: missing option-value' => [
        ['optionLabel' => 'name'],
        'The {option-value} and {option-label} attributes must be set together.',
    ],
    'flip-options cannot be used with option-value and option-label' => [
        [
            'optionValue' => 'id',
            'optionLabel' => 'name',
            'flipOptions' => true,
        ],
        'The {flip-options} attribute cannot be used with {option-value} and {option-label} attributes.',
    ],
    'only primitive values can be used without a {option-value} and {option-label} attributes' => [
        [
            'options' => [
                ['id' => 1, 'name' => 'Option 1'],
                ['id' => 2, 'name' => 'Option 2'],
            ],
        ],
        'Inform the {option-value} and {option-label} to use array, model, or object option.'
            . ' <x-select [...] option-value="id" option-label="name" />',
    ],
    'option-value and option-label cannot be used with primitive options' => [
        [
            'optionValue' => 'id',
            'optionLabel' => 'name',
            'options'     => ['name', 'id', 'email'],
        ],
        'The {option-value} and {option-label} attributes cannot be used with primitive options values: '
            . implode(', ', NativeSelect::PRIMITIVE_VALUES),
    ],
]);

test('it should allow using option key value with option label', function () {
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
});

it('should flip the component options when the flip options is true', function () {
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
});

it('should get the key as value when the option key value is true', function () {
    $component = new NativeSelect(
        optionKeyValue: true,
        options: [
            'A' => 'Option 1',
            'B' => 'Option 2',
        ]
    );

    $this->assertEquals('A', $component->getOptionValue('A', $component->options->first()));
});

it('should get the option value without an option value attribute', function () {
    $component = new NativeSelect(
        optionKeyValue: false,
        options: [
            'A' => 'Option 1',
            'B' => 'Option 2',
        ]
    );

    $this->assertEquals('Option 1', $component->getOptionValue('A', $component->options->first()));
});

it('should get the option value using the option value attribute', function () {
    $component = new NativeSelect(
        optionValue: 'id',
        optionLabel: 'name',
        options: [
            ['id' => 1, 'name' => 'Option 1'],
            ['id' => 2, 'name' => 'Option 2'],
        ]
    );

    $this->assertEquals(1, $component->getOptionValue(0, $component->options->first()));
});

it('should get the label without option label', function () {
    $component = new NativeSelect(
        options: [
            'A' => 'Option 1',
            'B' => 'Option 2',
        ]
    );

    $this->assertEquals('Option 1', $component->getOptionLabel($component->options->first()));
});

it('should get the label with option label', function () {
    $component = new NativeSelect(
        optionValue: 'id',
        optionLabel: 'name',
        options: [
            ['id' => 1, 'name' => 'Option 1'],
            ['id' => 2, 'name' => 'Option 2'],
        ]
    );

    $this->assertEquals('Option 1', $component->getOptionLabel($component->options->first()));
});
