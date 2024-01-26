<?php

namespace WireUi\Components\Badge\tests\Unit;

use WireUi\Components\Badge\Mini;
use WireUi\Components\Badge\WireUi\Color\Outline;
use WireUi\Components\Badge\WireUi\IconSize;
use WireUi\Components\Badge\WireUi\Size\Mini as SizeMini;
use WireUi\WireUi\Rounded;

beforeEach(function () {
    $this->component = (new Mini())->withName('mini-badge');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['icon-size']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'icon'  => null,
        'label' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        'icon',
        'size',
        'color',
        'label',
        'rounded',
        'squared',
        'variant',
        'iconSize',
        'sizeClasses',
        'colorClasses',
        'roundedClasses',
        'iconSizeClasses',
    ]);
});

test('it should not have properties in component', function () {
    expect($this->component)->not->toHaveProperties([
        'icon',
        'label',
        'iconSize',
        'iconSizeClasses',
    ]);
});

test('it should set specific label in component', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);

    expect('<x-mini-badge :$label />')->render(compact('label'))->toContain($label);
});

test('it should set icon and right icon in component with lg size', function () {
    $this->setAttributes($this->component, [
        'size' => $size = 'lg',
        'icon' => $icon = $this->getRandomIcon(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->icon)->toBe($icon);

    expect($this->component->size)->toBe($size);

    expect($this->component->iconSize)->toBe($size);

    expect($this->component->sizeClasses)->toBe($sizeClasses = (new SizeMini())->get($size));

    expect($this->component->iconSizeClasses)->toBe($iconSizeClasses = (new IconSize())->get($size));

    expect('<x-mini-badge :$size :$icon />')
        ->render(compact('size', 'icon'))
        ->toContain($sizeClasses)
        ->toContain(render('<x-icon :name="$icon" @class([$iconSizeClasses, "shrink-0"]) />', compact('icon', 'iconSizeClasses')));
});

test('it should set specific color in component with variant outline', function () {
    $this->setAttributes($this->component, [
        'color'   => 'info',
        'variant' => 'outline',
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->color)->toBe($color = 'info');

    expect($this->component->variant)->toBe($variant = 'outline');

    expect($this->component->colorClasses)->toBe($class = (new Outline())->get('info'));

    expect('<x-mini-badge :$color :$variant />')->render(compact('color', 'variant'))->toContain($class);
});

test('it should set rounded full in component', function () {
    $this->setAttributes($this->component, [
        'rounded' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->rounded)->toBeTrue();

    expect($this->component->squared)->toBeFalse();

    expect($this->component->roundedClasses)->toBe($class = (new Rounded())->get('full'));

    expect('<x-mini-badge rounded />')->render()->toContain($class);
});

test('it should set squared in component', function () {
    $this->setAttributes($this->component, [
        'squared' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->squared)->toBeTrue();

    expect($this->component->rounded)->toBeFalse();

    expect($this->component->roundedClasses)->toBe($class = (new Rounded())->get('none'));

    expect('<x-mini-badge squared />')->render()->toContain($class);
});

test('it should custom rounded in component', function () {
    $this->setAttributes($this->component, [
        'rounded' => $class = 'rounded-[40px]',
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->squared)->toBeFalse();

    expect($this->component->rounded)->toBe($class);

    expect($this->component->roundedClasses)->toBe($class);

    expect('<x-mini-badge rounded="rounded-[40px]" />')->render()->toContain($class);
});
