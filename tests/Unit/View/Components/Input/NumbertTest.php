<?php

namespace Tests\Unit\View\Components\Input;

use Illuminate\Support\Facades\Blade;
use WireUi\Enum\Packs;
use WireUi\View\Components\Input\Number;
use WireUi\WireUi\Shadow;
use WireUi\WireUi\Wrapper\{Color, Rounded};

beforeEach(function () {
    $this->component = new Number();

    $this->component->componentName = 'number';
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['shadow']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe(['shadowless', 'icon' => 'minus', 'right-icon' => 'plus']);
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

test('it should set specific icons in component', function () {
    $this->setAttributes($this->component, [
        'icon'       => $icon      = $this->getRandomIcon(),
        'right-icon' => $rightIcon = $this->getRandomIcon(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->icon)->toBe($icon);

    expect($this->component->rightIcon)->toBe($rightIcon);
});

test('it should set specific shadow in component', function () {
    $this->setAttributes($this->component, [
        'shadowless' => true,
        'shadow'     => Packs\Shadow::MD,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->shadowless)->toBeTrue();

    expect($this->component->shadow)->toBe(Packs\Shadow::MD);

    expect($this->component->shadowClasses)->toBe((new Shadow())->get(Packs\Shadow::MD));
});

test('it should set specific color in component', function () {
    $this->setAttributes($this->component, [
        'color' => Packs\Color::INFO,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->color)->toBe(Packs\Color::INFO);

    expect($this->component->colorClasses)->toBe((new Color())->get(Packs\Color::INFO));
});

test('it should set specific rounded in component', function () {
    $this->setAttributes($this->component, [
        'rounded' => true,
        'squared' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->rounded)->toBeTrue();

    expect($this->component->squared)->toBeTrue();

    expect($this->component->roundedClasses)->toBe((new Rounded())->get(Packs\Rounded::NONE));
});

// test('it should render component', function(){
//     $html = Blade::renderComponent($this->component);

//     dd($html);
// });
