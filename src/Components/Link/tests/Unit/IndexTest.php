<?php

namespace WireUi\Components\Link\tests\Unit;

use WireUi\Components\Link\Index as Link;
use WireUi\Components\Link\WireUi\Color;
use WireUi\Components\Link\WireUi\Size;
use WireUi\Components\Link\WireUi\Underline;

beforeEach(function () {
    $this->component = (new Link)->withName('link');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['underline']);

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
        // Packs
        'tag',
        'size',
        'color',
        'underline',
        'sizeClasses',
        'colorClasses',
        'underlineClasses',
    ]);
});

test('it should set specific label in component', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);

    expect('<x-link :$label />')->render(compact('label'))->toContain($label);
});

test('it should set random size in component', function () {
    $pack = $this->getRandomPack(Size::class);

    $this->setAttributes($this->component, [
        'size' => $size = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $sizeClasses = data_get($pack, 'class');

    expect($this->component->size)->toBe($size);
    expect($this->component->sizeClasses)->toBe($sizeClasses);

    expect('<x-link :$size />')->render(compact('size'))->toContain($sizeClasses);
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

    expect('<x-link :$color />')->render(compact('color'))->toContain($class);
});

test('it should set random underline in component', function () {
    $pack = $this->getRandomPack(Underline::class);

    $this->setAttributes($this->component, [
        'underline' => $underline = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->underline)->toBe($underline);
    expect($this->component->underlineClasses)->toBe($class);

    expect('<x-link :$underline />')->render(compact('underline'))->toContain($class);
});
