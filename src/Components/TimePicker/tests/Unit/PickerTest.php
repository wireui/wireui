<?php

namespace WireUi\Components\TimePicker\tests\Unit;

use WireUi\Components\TimePicker\Picker as TimePicker;
use WireUi\Components\Wrapper\WireUi\Color;
use WireUi\Components\Wrapper\WireUi\Rounded;
use WireUi\WireUi\Shadow;

beforeEach(function () {
    $this->component = (new TimePicker)->withName('time-picker');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe([]);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'label' => null,
        'right-icon' => 'clock',
        'military-time' => false,
        'without-seconds' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'label',
        'rightIcon',
        'militaryTime',
        'withoutSeconds',
        // Packs
        'color',
        'rounded',
        'squared',
        'colorClasses',
        'roundedClasses',
    ]);

    expect($this->component->rightIcon)->toBe('clock');
    expect($this->component->militaryTime)->toBeFalse();
    expect($this->component->withoutSeconds)->toBeFalse();
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

    expect('<x-time-picker :$color />')
        ->render(compact('color'))
        ->toContain(data_get($class, 'input'));
});

test('it should set random shadow in component', function () {
    $pack = $this->getRandomPack(Shadow::class);

    $this->setAttributes($this->component, [
        'shadow' => $shadow = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    expect('<x-time-picker :$shadow />')
        ->render(compact('shadow'))
        ->toContain(data_get($pack, 'class'));
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

    expect('<x-time-picker :$rounded />')
        ->render(compact('rounded'))
        ->toContain(data_get($class, 'input'));
});
