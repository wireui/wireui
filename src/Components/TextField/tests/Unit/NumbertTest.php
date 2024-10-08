<?php

namespace WireUi\Components\TextField\tests\Unit;

use WireUi\Components\TextField\Number;
use WireUi\Components\Wrapper\WireUi\Color;
use WireUi\Components\Wrapper\WireUi\Rounded;
use WireUi\WireUi\Shadow;

beforeEach(function () {
    $this->component = (new Number)->withName('number');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe([]);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'icon' => 'minus',
        'right-icon' => 'plus',
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'icon',
        'rightIcon',
        // Packs
        'color',
        'rounded',
        'squared',
        'colorClasses',
        'roundedClasses',
    ]);

    expect($this->component->icon)->toBe('minus');
    expect($this->component->rightIcon)->toBe('plus');
});

test('it should set icon and right icon in component', function () {
    $this->setAttributes($this->component, [
        'icon' => $icon = $this->getRandomIcon(),
        'right-icon' => $rightIcon = $this->getRandomIcon(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->icon)->toBe($icon);
    expect($this->component->rightIcon)->toBe($rightIcon);

    expect('<x-number :$icon :$rightIcon />')->render(compact('icon', 'rightIcon'))
        ->toContain(render('<x-icon :name="$icon" class="w-4 h-4 shrink-0" />', compact('icon')))
        ->toContain(render('<x-icon :name="$rightIcon" class="w-4 h-4 shrink-0" />', compact('rightIcon')));
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

    expect('<x-number :$color />')
        ->render(compact('color'))
        ->toContain(data_get($class, 'input'));
});

test('it should set html attributes in component', function () {
    $this->setAttributes($this->component, [
        'min' => $min = 5,
        'max' => $max = 10,
        'step' => $step = 2,
    ]);

    $this->runWireUiComponent($this->component);

    $attributes = $this->component->attributes->getAttributes();

    expect(data_get($attributes, 'min'))->toBe($min);
    expect(data_get($attributes, 'max'))->toBe($max);
    expect(data_get($attributes, 'step'))->toBe($step);

    expect('<x-number :$min :$max :$step />')
        ->render(compact('min', 'max', 'step'))
        ->toContain('min="5"', 'max="10"', 'step="2"');
});

test('it should set random shadow in component', function () {
    $pack = $this->getRandomPack(Shadow::class);

    $this->setAttributes($this->component, [
        'shadow' => $shadow = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    expect('<x-number :$shadow />')
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

    expect('<x-number :$rounded />')->render(compact('rounded'))->toContain(...$class);
});
