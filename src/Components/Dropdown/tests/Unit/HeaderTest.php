<?php

namespace WireUi\Components\Dropdown\tests\Unit;

use WireUi\Components\Dropdown\Header as DropdownHeader;

beforeEach(function () {
    $this->component = (new DropdownHeader)->withName('dropdown.header');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'label' => null,
        'separator' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
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

    expect('<x-dropdown.header :$label separator />')
        ->render(compact('label'))
        ->toContain($label, 'border');
});
