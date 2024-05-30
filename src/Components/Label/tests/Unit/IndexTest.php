<?php

namespace WireUi\Components\Badge\tests\Unit;

use WireUi\Components\Label\Index as Label;

beforeEach(function () {
    $this->component = (new Label())->withName('label');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'label' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'label',
    ]);
});

test('it should set specific label in component', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);

    expect('<x-label :$label />')->render(compact('label'))->toContain($label);
});
