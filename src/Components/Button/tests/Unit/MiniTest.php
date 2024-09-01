<?php

namespace WireUi\Components\Button\tests\Unit;

use Illuminate\Support\Arr;
use WireUi\Components\Button\Mini;
use WireUi\Components\Button\WireUi\IconSize;
use WireUi\Components\Button\WireUi\Size\Mini as SizeMini;
use WireUi\Components\Button\WireUi\Variant;
use WireUi\Enum\Packs;
use WireUi\Enum\Packs\Color;
use WireUi\WireUi\Rounded;

beforeEach(function () {
    $this->component = (new Mini)->withName('mini-button');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['icon-size']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'icon' => null,
        'label' => null,
        'wire-load-enabled' => false,
        'use-validation-colors' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'icon',
        'label',
        'wireLoadEnabled',
        'useValidationColors',
        // Packs
        'size',
        'color',
        'rounded',
        'squared',
        'variant',
        'sizeClasses',
        'colorClasses',
        'roundedClasses',
    ]);

    expect($this->component->wireLoadEnabled)->toBeFalse();
    expect($this->component->useValidationColors)->toBeFalse();
});

test('it should render button like link', function () {
    $this->setAttributes($this->component, [
        'href' => $href = fake()->url(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->tag)->toBe('a');

    expect('<x-mini-button :$href />')->render(compact('href'))->toContain($href);
});

test('it should set specific label in component', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);

    expect('<x-mini-button :$label />')->render(compact('label'))->toContain($label);
});

test('it should set icon in component with random size', function () {
    $pack = $this->getRandomPack(SizeMini::class);

    $this->setAttributes($this->component, [
        'size' => $size = data_get($pack, 'key'),
        'icon' => $icon = $this->getRandomIcon(),
    ]);

    $this->runWireUiComponent($this->component);

    $sizeClasses = data_get($pack, 'class');
    $iconSizeClasses = (new IconSize)->get($size);

    expect($this->component->icon)->toBe($icon);
    expect($this->component->size)->toBe($size);
    expect($this->component->iconSize)->toBe($size);
    expect($this->component->sizeClasses)->toBe($sizeClasses);
    expect($this->component->iconSizeClasses)->toBe($iconSizeClasses);

    expect('<x-mini-button :$size :$icon />')
        ->render(compact('size', 'icon'))
        ->toContain($sizeClasses)
        ->toContain(render('<x-icon :name="$icon" @class([$iconSizeClasses, "shrink-0"]) />', compact('icon', 'iconSizeClasses')));
});

test('it should set random color and variant in component', function () {
    $pack = $this->getVariantRandomPack(Variant::class, 'color', [Color::NONE]);

    $this->setAttributes($this->component, [
        'color' => $color = data_get($pack, 'key'),
        'variant' => $variant = data_get($pack, 'variant'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->color)->toBe($color);
    expect($this->component->variant)->toBe($variant);
    expect($this->component->colorClasses)->toBe($class);

    expect('<x-mini-button :$color :$variant />')
        ->render(compact('color', 'variant'))
        ->toContain(Arr::toRecursiveCssClasses($class));
});

test('it should set rounded full in component', function () {
    $this->setAttributes($this->component, [
        'rounded' => true,
    ]);

    $this->runWireUiComponent($this->component);

    $class = (new Rounded)->get(Packs\Rounded::FULL);

    expect($this->component->rounded)->toBeTrue();
    expect($this->component->squared)->toBeFalse();
    expect($this->component->roundedClasses)->toBe($class);

    expect('<x-mini-button rounded />')->render()->toContain($class);
});

test('it should set squared in component', function () {
    $this->setAttributes($this->component, [
        'squared' => true,
    ]);

    $this->runWireUiComponent($this->component);

    $class = (new Rounded)->get(Packs\Rounded::NONE);

    expect($this->component->squared)->toBeTrue();
    expect($this->component->rounded)->toBeFalse();
    expect($this->component->roundedClasses)->toBe($class);

    expect('<x-mini-button squared />')->render()->toContain($class);
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

    expect('<x-mini-button :$rounded />')->render(compact('rounded'))->toContain($class);
});
