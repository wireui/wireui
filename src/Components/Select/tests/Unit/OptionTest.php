<?php

namespace WireUi\Components\Select\tests\Unit;

use WireUi\Components\Select\Option;
use WireUi\Facades\WireUi;

beforeEach(function () {
    $this->component = (new Option)->withName('select.option');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'value' => null,
        'label' => null,
        'option' => [],
        'disabled' => false,
        'readonly' => false,
        'description' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'value',
        'label',
        'option',
        'disabled',
        'readonly',
        'description',
    ]);

    expect($this->component->option)->toBe([]);
    expect($this->component->disabled)->toBeFalse();
    expect($this->component->readonly)->toBeFalse();
});

test('it should render option with label, value and description', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
        'value' => $value = fake()->randomNumber(5),
        'description' => $description = fake()->sentence(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);
    expect($this->component->value)->toBe($value);
    expect($this->component->description)->toBe($description);

    $array = htmlspecialchars(WireUi::toJs($this->component->toArray()));

    expect('<x-select.option :$label :$value :$description />')
        ->render(compact('label', 'value', 'description'))
        ->toContain($array);
});

test('it should render option with disabled attribute', function () {
    $this->setAttributes($this->component, [
        'disabled' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->disabled)->toBeTrue();

    $array = htmlspecialchars(WireUi::toJs($this->component->toArray()));

    expect('<x-select.option disabled />')->render()->toContain($array);
});

test('it should render option with readonly attribute', function () {
    $this->setAttributes($this->component, [
        'readonly' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->readonly)->toBeTrue();

    $array = htmlspecialchars(WireUi::toJs($this->component->toArray()));

    expect('<x-select.option readonly />')->render()->toContain($array);
});
