<?php

namespace WireUi\Components\Avatar\tests\Unit;

use WireUi\Components\Avatar\Index as Avatar;
use WireUi\Components\Avatar\WireUi\IconSize;
use WireUi\Components\Avatar\WireUi\Size;
use WireUi\Enum\Packs;
use WireUi\WireUi\Rounded;

beforeEach(function () {
    $this->component = (new Avatar)->withName('avatar');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['border', 'icon-size']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'alt' => null,
        'src' => null,
        'icon' => null,
        'label' => null,
        'borderless' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'src',
        'icon',
        'label',
        'borderless',
        // Packs
        'size',
        'color',
        'border',
        'rounded',
        'squared',
        'iconSize',
        'sizeClasses',
        'colorClasses',
        'borderClasses',
        'roundedClasses',
        'iconSizeClasses',
    ]);

    expect($this->component->borderless)->toBeFalse();
});

test('it should render label in component', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);

    expect('<x-avatar :$label />')->render(compact('label'))->toContain($label);
});

test('it should render link photo in component', function () {
    $this->setAttributes($this->component, [
        'src' => $src = fake()->url(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->src)->toBe($src);

    expect('<x-avatar :$src />')->render(compact('src'))->toContain($src);
});

test('it should render icon in component', function () {
    $pack = $this->getRandomPack(Size::class);

    $this->setAttributes($this->component, [
        'icon' => $icon = $this->getRandomIcon(),
        'size' => $size = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $sizeClasses = data_get($pack, 'class');
    $iconSizeClasses = (new IconSize)->get($size);

    expect($this->component->icon)->toBe($icon);
    expect($this->component->size)->toBe($size);
    expect($this->component->iconSize)->toBe($size);
    expect($this->component->sizeClasses)->toBe($sizeClasses);
    expect($this->component->iconSizeClasses)->toBe($iconSizeClasses);

    $iconSizeClasses = data_get($iconSizeClasses, 'icon');

    $html = render('<x-icon :name="$icon" @class([$iconSizeClasses, "text-white dark:text-gray-200 shrink-0"]) solid />', compact('icon', 'iconSizeClasses'));

    expect('<x-avatar :$icon :$size />')
        ->render(compact('icon', 'size'))
        ->toContain($html)
        ->toContain($sizeClasses);
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

    expect('<x-avatar rounded />')->render()->toContain($class);
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

    expect('<x-avatar squared />')->render()->toContain($class);
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

    expect('<x-avatar :$rounded />')->render(compact('rounded'))->toContain($class);
});
