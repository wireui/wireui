<?php

namespace WireUi\Components\Select\tests\Unit;

use WireUi\Components\Select\UserOption;
use WireUi\Facades\WireUi;

beforeEach(function () {
    $this->component = (new UserOption)->withName('select.user-option');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'src' => null,
        'label' => null,
        'option' => [],
        'description' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'src',
        'label',
        'option',
        'description',
    ]);

    expect($this->component->option)->toBe([]);
});

test('it should render option with label, value and description', function () {
    $this->setAttributes($this->component, [
        'src' => $src = fake()->imageUrl(),
        'label' => $label = fake()->word(),
        'value' => $value = fake()->randomNumber(5),
        'description' => $description = fake()->sentence(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);
    expect($this->component->description)->toBe($description);

    $array = htmlspecialchars(WireUi::toJs([
        'label' => $label,
        'value' => $value,
        'description' => $description,
    ]));

    expect('<x-select.user-option :$label :$value :$description />')
        ->render(compact('label', 'value', 'description'))
        ->toContain($array);
});

test('it should render option with disabled attribute', function () {
    $this->setAttributes($this->component, [
        'disabled' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->attributes->get('disabled'))->toBeTrue();

    $array = htmlspecialchars(WireUi::toJs([
        'disabled' => true,
        'readonly' => true,
    ]));

    expect('<x-select.user-option disabled />')->render()->toContain($array);
});

test('it should render option with readonly attribute', function () {
    $this->setAttributes($this->component, [
        'readonly' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->attributes->get('readonly'))->toBeTrue();

    $array = htmlspecialchars(WireUi::toJs([
        'readonly' => true,
    ]));

    expect('<x-select.user-option readonly />')->render()->toContain($array);
});
