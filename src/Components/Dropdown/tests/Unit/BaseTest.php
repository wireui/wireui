<?php

namespace WireUi\Components\Dropdown\tests\Unit;

use WireUi\Components\Dropdown\Base as Dropdown;
use WireUi\Components\Dropdown\WireUi\Height;
use WireUi\Components\Dropdown\WireUi\Width;

beforeEach(function () {
    $this->component = (new Dropdown)->withName('dropdown');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['width', 'height']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'icon' => 'ellipsis-vertical',
        'position' => null,
        'persistent' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'icon',
        'position',
        'persistent',
        // Packs
        'width',
        'height',
        'widthClasses',
        'heightClasses',
    ]);

    expect($this->component->persistent)->toBeFalse();
    expect($this->component->icon)->toBe('ellipsis-vertical');
});

test('it should set random icon in component with persistent', function () {
    $this->setAttributes($this->component, [
        'icon' => $icon = $this->getRandomIcon(),
        'persistent' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->icon)->toBe($icon);
    expect($this->component->persistent)->toBeTrue();

    $html = render(<<<'EOT'
    <x-icon :name="$icon" @class([
        'dark:hover:text-secondary-600 transition duration-150 ease-in-out',
        'w-4 h-4 text-secondary-500 hover:text-secondary-700',
    ]) />
    EOT, compact('icon'));

    expect('<x-dropdown :$icon persistent />')
        ->render(compact('icon'))->toContain($html)
        ->not->toContain('x-on:click="positionable.close()"');
});

test('it should set random width in component', function () {
    $pack = $this->getRandomPack(Width::class);

    $this->setAttributes($this->component, [
        'width' => $width = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->width)->toBe($width);
    expect($this->component->widthClasses)->toBe($class);

    expect('<x-dropdown :$width />')->render(compact('width'))->toContain($class);
});

test('it should set random height in component', function () {
    $pack = $this->getRandomPack(Height::class);

    $this->setAttributes($this->component, [
        'height' => $height = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->height)->toBe($height);
    expect($this->component->heightClasses)->toBe($class);

    expect('<x-dropdown :$height />')->render(compact('height'))->toContain($class);
});
