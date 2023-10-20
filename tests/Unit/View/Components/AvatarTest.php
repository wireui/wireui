<?php

namespace Tests\Unit\View\Components;

use WireUi\Enum\Packs;
use WireUi\View\Components\Avatar;
use WireUi\WireUi\Avatar\{IconSize, Size};
use WireUi\WireUi\Rounded;

beforeEach(function () {
    $this->component = (new Avatar())->withName('avatar');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['border', 'icon-size']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'src'        => null,
        'icon'       => null,
        'label'      => null,
        'borderless' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        'src',
        'icon',
        'size',
        'color',
        'label',
        'border',
        'rounded',
        'squared',
        'iconSize',
        'borderless',
        'sizeClasses',
        'colorClasses',
        'borderClasses',
        'roundedClasses',
        'iconSizeClasses',
    ]);

    expect($this->component->borderless)->toBeFalse();
});

test('it should not have properties in component', function () {
    expect($this->component)->not->toHaveProperties([
        'src',
        'icon',
        'label',
        'border',
        'iconSize',
        'borderless',
        'borderClasses',
        'iconSizeClasses',
    ]);
});

test('it should render label in component', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);

    expect('<x-alert :$label />')->render(compact('label'))->toContain($label);
});

test('it should render link photo in component', function () {
    $this->setAttributes($this->component, [
        'src' => $src = fake()->url(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->src)->toBe($src);

    expect('<x-alert :src="$src" />')->render(compact('src'))->toContain($src);
});

test('it should render icon in component', function () {
    $this->setAttributes($this->component, [
        'icon' => $icon = $this->getRandomIcon(),
        'size' => $size = Packs\Size::SM,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->icon)->toBe($icon);

    expect($this->component->size)->toBe($size);

    expect($this->component->iconSize)->toBe($size);

    expect($this->component->sizeClasses)->toBe($sizeClasses = (new Size())->get($size));

    expect($this->component->iconSizeClasses)->toBe($iconSizeClasses = (new IconSize())->get($size));

    $iconSizeClasses = collect($iconSizeClasses)->get('icon');

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

    expect($this->component->rounded)->toBeTrue();

    expect($this->component->squared)->toBeFalse();

    expect($this->component->roundedClasses)->toBe($class = (new Rounded())->get(Packs\Rounded::FULL));

    expect('<x-avatar rounded />')->render()->toContain($class);
});

test('it should set squared in component', function () {
    $this->setAttributes($this->component, [
        'squared' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->squared)->toBeTrue();

    expect($this->component->rounded)->toBeFalse();

    expect($this->component->roundedClasses)->toBe($class = (new Rounded())->get(Packs\Rounded::NONE));

    expect('<x-avatar squared />')->render()->toContain($class);
});

test('it should custom rounded in component', function () {
    $this->setAttributes($this->component, [
        'rounded' => $class = 'rounded-[40px]',
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->squared)->toBeFalse();

    expect($this->component->rounded)->toBe($class);

    expect($this->component->roundedClasses)->toBe($class);

    expect('<x-avatar rounded="rounded-[40px]" />')->render()->toContain($class);
});
