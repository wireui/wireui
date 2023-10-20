<?php

namespace Tests\Unit\View\Components\Input;

use Illuminate\Support\Facades\Blade;
use WireUi\Enum\Packs;
use WireUi\View\Components\Input\Number;
use WireUi\WireUi\Shadow;
use WireUi\WireUi\Wrapper\{Color, Rounded};

beforeEach(function () {
    $this->component = (new Number())->withName('number');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['shadow']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'icon'       => 'minus',
        'right-icon' => 'plus',
        'shadowless' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        'icon',
        'color',
        'shadow',
        'rounded',
        'squared',
        'rightIcon',
        'shadowless',
        'colorClasses',
        'shadowClasses',
        'roundedClasses',
    ]);

    expect($this->component->icon)->toBe('minus');

    expect($this->component->rightIcon)->toBe('plus');

    expect($this->component->shadowless)->toBeFalse();
});

test('it should not have properties in component', function () {
    expect($this->component)->not->toHaveProperties([
        'icon',
        'shadow',
        'rightIcon',
        'shadowless',
        'shadowClasses',
    ]);
});

test('it should set icon and right icon in component', function () {
    $this->setAttributes($this->component, [
        'icon'       => $icon      = $this->getRandomIcon(),
        'right-icon' => $rightIcon = $this->getRandomIcon(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->icon)->toBe($icon);

    expect($this->component->rightIcon)->toBe($rightIcon);

    expect(Blade::render("<x-number icon=\"{$icon}\" rightIcon=\"{$rightIcon}\" />"))
        ->toContain(Blade::render("<x-icon name=\"{$icon}\" class=\"w-4 h-4 shrink-0\" />"))
        ->toContain(Blade::render("<x-icon name=\"{$rightIcon}\" class=\"w-4 h-4 shrink-0\" />"));
});

test('it should set specific shadow in component', function () {
    $this->setAttributes($this->component, [
        'shadow' => Packs\Shadow::MD,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->shadowless)->toBeFalse();

    expect($this->component->shadow)->toBe(Packs\Shadow::MD);

    expect($this->component->shadowClasses)->toBe($class = (new Shadow())->get(Packs\Shadow::MD));

    expect(Blade::render('<x-number shadow="md" />'))->toContain($class);
});

test('it should remove shadow in component when is shadowless', function () {
    $this->setAttributes($this->component, [
        'shadowless' => true,
        'shadow'     => Packs\Shadow::MD,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->shadowless)->toBeTrue();

    expect($this->component->shadow)->toBe(Packs\Shadow::MD);

    expect($this->component->shadowClasses)->toBe($class = (new Shadow())->get(Packs\Shadow::MD));

    expect(Blade::render('<x-number shadowless shadow="md" />'))->not->toContain($class);
});

test('it should set specific color in component', function () {
    $this->setAttributes($this->component, [
        'color' => Packs\Color::INFO,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->color)->toBe($color = Packs\Color::INFO);

    expect($this->component->colorClasses)->toBe($class = (new Color())->get(Packs\Color::INFO));

    expect(Blade::render("<x-number color=\"{$color}\" />"))->toContain(data_get($class, 'input'));
});

test('it should set rounded full in component', function () {
    $this->setAttributes($this->component, [
        'rounded' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->rounded)->toBeTrue();

    expect($this->component->squared)->toBeFalse();

    expect($this->component->roundedClasses)->toBe($class = (new Rounded())->get(Packs\Rounded::FULL));

    expect(Blade::render('<x-number rounded />'))->toContain(data_get($class, 'input'));
});

test('it should set squared in component', function () {
    $this->setAttributes($this->component, [
        'squared' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->squared)->toBeTrue();

    expect($this->component->rounded)->toBeFalse();

    expect($this->component->roundedClasses)->toBe($class = (new Rounded())->get(Packs\Rounded::NONE));

    expect(Blade::render('<x-number squared />'))->toContain(data_get($class, 'input'));
});
