<?php

namespace Tests\Unit\Traits\Components;

use WireUi\Components\Button\Base as Button;
use WireUi\Components\Button\WireUi\Color\Solid;
use WireUi\Components\Button\WireUi\Variant;
use WireUi\Enum\Packs\Color;

beforeEach(function () {
    $this->component = (new Button)->withName('button');

    $this->invokeMethod($this->component, 'setConfig');
});

test('it should get config color name', function () {
    $this->component->variant = 'variant';

    $name = $this->invokeMethod($this->component, 'getColorConfigName');

    expect($name)->toBe('wireui.button.packs.colors.variant');

    $this->component->variant = null;

    $name = $this->invokeMethod($this->component, 'getColorConfigName');

    expect($name)->toBe('wireui.button.packs.colors');

    $name = $this->invokeMethod($this->component, 'getColorConfigName', ['variant1']);

    expect($name)->toBe('wireui.button.packs.colors.variant1');
});

test('it should set color resolve', function () {
    expect($this->invokeProperty($this->component, 'colorResolve'))->toBeNull();

    $this->invokeMethod($this->component, 'setColorResolve', [Solid::class]);

    expect($this->invokeProperty($this->component, 'colorResolve'))->toBe(Solid::class);
});

test('it should setup color', function () {
    $pack = $this->getVariantRandomPack(Variant::class, 'color', [Color::NONE]);

    $color = data_get($pack, 'key');
    $class = data_get($pack, 'class');
    $variant = data_get($pack, 'variant');
    $colorResolve = data_get((new Variant)->get($variant), 'color');

    $this->invokeMethod($this->component, 'setColorResolve', [$colorResolve]);

    $this->setAttributes($this->component, [
        'color' => $color,
        'variant' => $variant,
    ]);

    $this->component->variant = $variant;

    $this->invokeMethod($this->component, 'mountColor');

    expect($this->component->color)->toBe($color);
    expect($this->component->colorClasses)->toBe($class);
});
