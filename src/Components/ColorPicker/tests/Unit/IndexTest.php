<?php

namespace WireUi\Components\ColorPicker\tests\Unit;

use WireUi\Components\ColorPicker\Index as ColorPicker;

beforeEach(function () {
    $this->component = (new ColorPicker())->withName('color-picker');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['shadow']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'colors'              => [],
        'shadowless'          => false,
        'right-icon'          => 'swatch',
        'color-name-as-value' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        'colors',
        'shadow',
        'rightIcon',
        'shadowless',
        'shadowClasses',
        'colorNameAsValue',
    ]);

    expect($this->component->shadowless)->toBeFalse();
});

test('it should not have properties in component', function () {
    expect($this->component)->not->toHaveProperties([
        'colors',
        'shadow',
        'rightIcon',
        'shadowless',
        'shadowClasses',
        'colorNameAsValue',
    ]);
});

test('it can be instantiated with default parameters', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component->colors)->toBe([]);

    expect($this->component->rightIcon)->toBe('swatch');

    expect($this->component->colorNameAsValue)->toBe(false);
});

test('it can be instantiated with custom parameters', function () {
    $colors = collect(['red' => '#ff0000', 'green' => '#00ff00', 'blue' => '#0000ff']);

    $this->setAttributes($this->component, [
        'colors'              => $colors,
        'color-name-as-value' => true,
        'right-icon'          => $icon = $this->getRandomIcon(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->colors)->toBe($colors);

    expect($this->component->rightIcon)->toBe($icon);

    expect($this->component->colorNameAsValue)->toBe(true);
});

test('it transforms colors correctly', function () {
    $colors = ['red' => '#ff0000', 'green' => '#00ff00', '#0000ff'];

    $this->setAttributes($this->component, [
        'colors' => $colors,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->getColors())->toBe([
        ['value' => '#ff0000', 'name' => 'red'],
        ['value' => '#00ff00', 'name' => 'green'],
        ['value' => '#0000ff', 'name' => '#0000ff'],
    ]);
});

test('it returns an empty array when no colors are provided', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component->getColors())->toBe([]);
});

test('it handles colors as string correctly', function () {
    $colors = ['red', 'green', 'blue'];

    $this->setAttributes($this->component, [
        'colors' => $colors,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->getColors())->toBe([
        ['value' => 'red', 'name' => 'red'],
        ['value' => 'green', 'name' => 'green'],
        ['value' => 'blue', 'name' => 'blue'],
    ]);
});

test('it handles colors as associative array correctly', function () {
    $colors = ['red' => '#ff0000', 'green' => '#00ff00', 'blue' => '#0000ff'];

    $this->setAttributes($this->component, [
        'colors' => $colors,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->getColors())->toBe([
        ['value' => '#ff0000', 'name' => 'red'],
        ['value' => '#00ff00', 'name' => 'green'],
        ['value' => '#0000ff', 'name' => 'blue'],
    ]);
});

test('it handles mixed types in colors array correctly', function () {
    $colors = ['red' => '#ff0000', '#00ff00', 'blue' => '#0000ff'];

    $this->setAttributes($this->component, [
        'colors' => $colors,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->getColors())->toBe([
        ['value' => '#ff0000', 'name' => 'red'],
        ['value' => '#00ff00', 'name' => '#00ff00'],
        ['value' => '#0000ff', 'name' => 'blue'],
    ]);
});

test('it should pass custom colors to js component data', function () {
    expect('<x-color-picker :colors="$colors" />')
        ->render(['colors' => [['name' => 'FFF', 'value' => '#FFF']]])
        ->toContain('colors:JSON.parse(atob(&#039;W3sibmFtZSI6IkZGRiIsInZhbHVlIjoiI0ZGRiJ9XQ==&#039;))');
});
