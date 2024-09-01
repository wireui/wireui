<?php

namespace WireUi\Components\Dropdown\tests\Unit;

use WireUi\Components\Dropdown\Item as DropdownItem;

beforeEach(function () {
    $this->component = (new DropdownItem)->withName('dropdown.item');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'icon' => null,
        'label' => null,
        'separator' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'icon',
        'label',
        'separator',
    ]);

    expect($this->component->separator)->toBeFalse();
});

test('it should set random label in component with separator', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
        'separator' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);
    expect($this->component->separator)->toBeTrue();

    expect('<x-dropdown.item :$label separator />')
        ->render(compact('label'))
        ->toContain($label, 'border');
});
