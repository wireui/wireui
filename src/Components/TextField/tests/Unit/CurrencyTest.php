<?php

namespace WireUi\Components\TextField\tests\Unit;

use WireUi\Components\TextField\Currency;
use WireUi\Components\Wrapper\WireUi\Color;
use WireUi\Components\Wrapper\WireUi\Rounded;
use WireUi\WireUi\Shadow;

beforeEach(function () {
    $this->component = (new Currency())->withName('currency');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['shadow']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'decimal' => '.',
        'precision' => 2,
        'thousands' => ',',
        'shadowless' => false,
        'emit-formatted' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'decimal',
        'precision',
        'thousands',
        'shadowless',
        'emitFormatted',
        // Packs
        'color',
        'shadow',
        'rounded',
        'squared',
        'colorClasses',
        'shadowClasses',
        'roundedClasses',
    ]);

    expect($this->component->decimal)->toBe('.');
    expect($this->component->precision)->toBe(2);
    expect($this->component->thousands)->toBe(',');
    expect($this->component->shadowless)->toBeFalse();
    expect($this->component->emitFormatted)->toBeFalse();
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

    expect('<x-currency :$color />')->render(compact('color'))->toContain(...$class);
});

test('it should set random shadow in component', function () {
    $pack = $this->getRandomPack(Shadow::class);

    $this->setAttributes($this->component, [
        'shadow' => $shadow = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->shadow)->toBe($shadow);
    expect($this->component->shadowless)->toBeFalse();
    expect($this->component->shadowClasses)->toBe($class);

    expect('<x-currency :$shadow />')->render(compact('shadow'))->toContain($class);
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

    expect('<x-currency :$rounded />')
        ->render(compact('rounded'))
        ->toContain(data_get($class, 'input'));
});
