<?php

namespace WireUi\Components\Alert\tests\Unit;

use WireUi\Components\Alert\Index as Alert;
use WireUi\Components\Alert\WireUi\Variant;
use WireUi\Enum\Packs;
use WireUi\WireUi\Rounded;

beforeEach(function () {
    $this->component = (new Alert)->withName('alert');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['shadow', 'padding']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'icon' => null,
        'title' => null,
        'iconless' => false,
        'shadowless' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'icon',
        'title',
        'iconless',
        'shadowless',
        // Packs
        'color',
        'shadow',
        'padding',
        'rounded',
        'squared',
        'variant',
        'colorClasses',
        'shadowClasses',
        'paddingClasses',
        'roundedClasses',
    ]);

    expect($this->component->iconless)->toBeFalse();
    expect($this->component->shadowless)->toBeFalse();
});

test('it should set specific title in component', function () {
    $this->setAttributes($this->component, [
        'title' => $title = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->title)->toBe($title);

    expect('<x-alert :title="$title" />')->render(compact('title'))->toContain($title);
});

test('it should set icon in component and using iconless', function () {
    $title = fake()->word();

    $pack = $this->getVariantRandomPack(Variant::class, 'color');

    $this->setAttributes($this->component, [
        'icon' => $icon = $this->getRandomIcon(),
        'color' => $color = data_get($pack, 'key'),
        'variant' => $variant = data_get($pack, 'variant'),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->icon)->toBe($icon);
    expect($this->component->color)->toBe($color);
    expect($this->component->variant)->toBe($variant);
    expect($this->component->colorClasses)->toBe(data_get($pack, 'class'));

    $iconColor = data_get($pack, 'class.iconColor');

    $html = render('<x-icon :name="$icon" @class([$iconColor, "w-5 h-5 mr-3 shrink-0"]) />', compact('icon', 'iconColor'));

    expect('<x-alert :$icon :$color :$title :$variant />')
        ->render(compact('icon', 'color', 'title', 'variant'))
        ->toContain($html);

    expect('<x-alert :$icon :$color :$title :$variant iconless />')
        ->render(compact('icon', 'color', 'title', 'variant'))
        ->not->toContain($html);
});

test('it should set random color and variant in component', function () {
    $title = fake()->word();

    $pack = $this->getVariantRandomPack(Variant::class, 'color');

    $this->setAttributes($this->component, [
        'color' => $color = data_get($pack, 'key'),
        'variant' => $variant = data_get($pack, 'variant'),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->color)->toBe($color);
    expect($this->component->variant)->toBe($variant);
    expect($this->component->colorClasses)->toBe(data_get($pack, 'class'));

    $icon = data_get($pack, 'class.icon');
    $iconColor = data_get($pack, 'class.iconColor');

    $html = render('<x-icon :name="$icon" @class([$iconColor, "w-5 h-5 mr-3 shrink-0"]) />', compact('icon', 'iconColor'));

    expect('<x-alert :title="$title" :$color :$variant />')
        ->render(compact('title', 'color', 'variant'))
        ->toContain(...[
            data_get($pack, 'class.text'),
            data_get($pack, 'class.background'),
        ])->toContain($html);
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

    expect('<x-alert rounded />')->render()->toContain($class);
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

    expect('<x-alert squared />')->render()->toContain($class);
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

    expect('<x-alert :$rounded />')->render(compact('rounded'))->toContain($class);
});
