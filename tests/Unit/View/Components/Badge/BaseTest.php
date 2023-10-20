<?php

namespace Tests\Unit\View\Components\Badge;

use Illuminate\Support\Facades\Blade;
use WireUi\Enum\Packs;
use WireUi\View\Components\Badge\Base;
use WireUi\WireUi\Badge\Color\Outline;
use WireUi\WireUi\Badge\IconSize;
use WireUi\WireUi\Badge\Size\Base as SizeBase;
use WireUi\WireUi\Rounded;

beforeEach(function () {
    $this->component = (new Base())->withName('badge');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['icon-size']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'full'       => false,
        'icon'       => null,
        'label'      => null,
        'right-icon' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        'full',
        'icon',
        'size',
        'color',
        'label',
        'rounded',
        'squared',
        'variant',
        'iconSize',
        'rightIcon',
        'sizeClasses',
        'colorClasses',
        'roundedClasses',
        'iconSizeClasses',
    ]);

    expect($this->component->full)->toBeFalse();
});

test('it should not have properties in component', function () {
    expect($this->component)->not->toHaveProperties([
        'full',
        'icon',
        'label',
        'iconSize',
        'rightIcon',
        'iconSizeClasses',
    ]);
});

test('it should set specific label in component', function () {
    $this->setAttributes($this->component, [
        'label' => $label = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->label)->toBe($label);

    expect(Blade::render("<x-badge label=\"{$label}\" />"))->toContain($label);
});

test('it should set icon and right icon in component with lg size', function () {
    $this->setAttributes($this->component, [
        'size'       => $size      = Packs\Size::LG,
        'icon'       => $icon      = $this->getRandomIcon(),
        'right-icon' => $rightIcon = $this->getRandomIcon(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->icon)->toBe($icon);

    expect($this->component->size)->toBe($size);

    expect($this->component->iconSize)->toBe($size);

    expect($this->component->rightIcon)->toBe($rightIcon);

    expect($this->component->sizeClasses)->toBe($sizeClasses = (new SizeBase())->get($size));

    expect($this->component->iconSizeClasses)->toBe($iconSizeClasses = (new IconSize())->get($size));

    expect(Blade::render("<x-badge size=\"{$size}\" icon=\"{$icon}\" rightIcon=\"{$rightIcon}\" />"))
        ->toContain($sizeClasses)
        ->toContain(Blade::render("<x-icon name=\"{$icon}\" class=\"{$iconSizeClasses} shrink-0\" />"))
        ->toContain(Blade::render("<x-icon name=\"{$rightIcon}\" class=\"{$iconSizeClasses} shrink-0\" />"));
});

test('it should set specific color in component with variant outline', function () {
    $this->setAttributes($this->component, [
        'color'   => Packs\Color::INFO,
        'variant' => Packs\Variant::OUTLINE,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->color)->toBe($color = Packs\Color::INFO);

    expect($this->component->variant)->toBe($variant = Packs\Variant::OUTLINE);

    expect($this->component->colorClasses)->toBe($class = (new Outline())->get(Packs\Color::INFO));

    expect(Blade::render("<x-badge variant=\"{$variant}\" color=\"{$color}\" />"))->toContain($class);
});

test('it should set rounded full in component', function () {
    $this->setAttributes($this->component, [
        'rounded' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->rounded)->toBeTrue();

    expect($this->component->squared)->toBeFalse();

    expect($this->component->roundedClasses)->toBe($class = (new Rounded())->get(Packs\Rounded::FULL));

    expect(Blade::render('<x-badge rounded />'))->toContain($class);
});

test('it should set squared in component', function () {
    $this->setAttributes($this->component, [
        'squared' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->squared)->toBeTrue();

    expect($this->component->rounded)->toBeFalse();

    expect($this->component->roundedClasses)->toBe($class = (new Rounded())->get(Packs\Rounded::NONE));

    expect(Blade::render('<x-badge squared />'))->toContain($class);
});

test('it should custom rounded in component', function () {
    $this->setAttributes($this->component, [
        'rounded' => $class = 'rounded-[40px]',
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->squared)->toBeFalse();

    expect($this->component->rounded)->toBe($class);

    expect($this->component->roundedClasses)->toBe($class);

    expect(Blade::render('<x-badge rounded="rounded-[40px]" />'))->toContain($class);
});
