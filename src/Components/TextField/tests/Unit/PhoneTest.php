<?php

namespace WireUi\Components\TextField\tests\Unit;

use WireUi\Components\TextField\Phone;
use WireUi\Components\Wrapper\WireUi\Color;
use WireUi\Components\Wrapper\WireUi\Rounded;
use WireUi\WireUi\Shadow;

beforeEach(function () {
    $this->component = (new Phone)->withName('phone');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe([]);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'mask' => null,
        'emit-formatted' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->setAttributes($this->component, [
        'mask' => '####',
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'mask',
        'emitFormatted',
    ]);

    expect($this->component->emitFormatted)->toBeFalse();
});

test('it should set random color in component', function () {
    $pack = $this->getRandomPack(Color::class);

    $this->setAttributes($this->component, [
        'color' => $color = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect('<x-phone :$color />')
        ->render(compact('color'))
        ->toContain(data_get($class, 'input'));
});

test('it should set random shadow in component', function () {
    $pack = $this->getRandomPack(Shadow::class);

    $this->setAttributes($this->component, [
        'shadow' => $shadow = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    expect('<x-phone :$shadow />')
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

    expect('<x-phone :$rounded />')
        ->render(compact('rounded'))
        ->toContain(data_get($class, 'input'));
});
