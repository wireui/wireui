<?php

namespace WireUi\Components\Switcher\tests\Unit;

use WireUi\Components\Switcher\Checkbox;
use WireUi\Components\Switcher\WireUi\Checkbox\Color;
use WireUi\Components\Switcher\WireUi\Checkbox\Size;
use WireUi\WireUi\Rounded;

beforeEach(function () {
    $this->component = (new Checkbox)->withName('checkbox');
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Packs
        'size',
        'color',
        'rounded',
        'squared',
        'sizeClasses',
        'colorClasses',
        'roundedClasses',
    ]);
});

test('it should render label and description in component', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
        'description' => $description = fake()->sentence(),
    ]);

    $this->runWireUiComponent($this->component);

    expect('<x-checkbox :$label :$description />')
        ->render(compact('label', 'description'))
        ->toContain($label, $description);
});

test('it should render left label in component', function () {
    $this->setAttributes($this->component, [
        'left-label' => $leftLabel = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect('<x-checkbox :$leftLabel />')
        ->render(compact('leftLabel'))
        ->toContain($leftLabel);
});

test('it should set random color in component', function () {
    $pack = $this->getRandomPack(Color::class);

    $this->setAttributes($this->component, [
        'color' => $color = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->color)->toBe($color);
    expect($this->component->colorClasses)->toBe($class);

    expect('<x-checkbox :$color />')->render(compact('color'))->toContain($class);
});

test('it should set random size in component', function () {
    $pack = $this->getRandomPack(Size::class);

    $this->setAttributes($this->component, [
        'size' => $size = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->size)->toBe($size);
    expect($this->component->sizeClasses)->toBe($class);

    expect('<x-checkbox :$size />')->render(compact('size'))->toContain($class);
});

test('it should set random rounded in component', function () {
    $pack = $this->getRandomPack(Rounded::class);

    $this->setAttributes($this->component, [
        'rounded' => $rounded = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->squared)->toBeFalse();
    expect($this->component->rounded)->toBe($rounded);
    expect($this->component->roundedClasses)->toBe($class);

    expect('<x-checkbox :$rounded />')->render(compact('rounded'))->toContain($class);
});
