<?php

namespace Tests\Unit\Traits\Components;

use WireUi\Components\Button\Base as Button;
use WireUi\Components\Button\WireUi\Variant;
use WireUi\Enum\Packs\Color;

beforeEach(function () {
    $this->component = (new Button)->withName('button');

    $this->invokeMethod($this->component, 'setConfig');
});

test('it should set interaction with color and without variant', function () {
    $pack = $this->getVariantRandomPack(Variant::class, 'color', [Color::NONE]);
    $pack2 = $this->getRandomPack(data_get($pack, 'pack'), [Color::NONE, data_get($pack, 'key')]);

    $this->setAttributes($this->component, [
        'color' => data_get($pack, 'key'),
        'variant' => data_get($pack, 'variant'),
        'interaction' => data_get($pack2, 'key'),
    ]);

    $this->invokeMethod($this->component, 'mountVariant');
    $this->invokeMethod($this->component, 'mountColor');
    $this->invokeMethod($this->component, 'mountStateColor');

    expect($this->component->color)->toBe(data_get($pack, 'key'));
    expect($this->component->variant)->toBe(data_get($pack, 'variant'));

    expect(data_get($this->component->colorClasses, 'base'))->toBe(data_get($pack, 'class.base'));
    expect(data_get($this->component->colorClasses, 'hover'))->toBe(data_get($pack2, 'class.hover'));
    expect(data_get($this->component->colorClasses, 'focus'))->toBe(data_get($pack2, 'class.focus'));
});

test('it should set interaction with color and variant', function () {
    $pack = $this->getVariantRandomPack(Variant::class, 'color', [Color::NONE]);
    $pack2 = $this->getVariantRandomPack(Variant::class, 'color', [Color::NONE]);

    $variant2 = data_get($pack2, 'variant');

    $this->setAttributes($this->component, [
        'color' => data_get($pack, 'key'),
        'variant' => data_get($pack, 'variant'),
        "interaction:{$variant2}" => data_get($pack2, 'key'),
    ]);

    $this->invokeMethod($this->component, 'mountVariant');
    $this->invokeMethod($this->component, 'mountColor');
    $this->invokeMethod($this->component, 'mountStateColor');

    expect($this->component->color)->toBe(data_get($pack, 'key'));
    expect($this->component->variant)->toBe(data_get($pack, 'variant'));

    expect(data_get($this->component->colorClasses, 'base'))->toBe(data_get($pack, 'class.base'));
    expect(data_get($this->component->colorClasses, 'hover'))->toBe(data_get($pack2, 'class.hover'));
    expect(data_get($this->component->colorClasses, 'focus'))->toBe(data_get($pack2, 'class.focus'));
});

test('it should set hover and focus with only color', function () {
    $pack = $this->getVariantRandomPack(Variant::class, 'color', [Color::NONE]);
    $pack2 = $this->getRandomPack(data_get($pack, 'pack'), [Color::NONE, data_get($pack, 'key')]);
    $pack3 = $this->getRandomPack(data_get($pack, 'pack'), [Color::NONE, data_get($pack, 'key'), data_get($pack2, 'key')]);

    $this->setAttributes($this->component, [
        'color' => data_get($pack, 'key'),
        'variant' => data_get($pack, 'variant'),
        'hover' => data_get($pack2, 'key'),
        'focus' => data_get($pack3, 'key'),
    ]);

    $this->invokeMethod($this->component, 'mountVariant');
    $this->invokeMethod($this->component, 'mountColor');
    $this->invokeMethod($this->component, 'mountStateColor');

    expect($this->component->color)->toBe(data_get($pack, 'key'));
    expect($this->component->variant)->toBe(data_get($pack, 'variant'));

    expect(data_get($this->component->colorClasses, 'base'))->toBe(data_get($pack, 'class.base'));
    expect(data_get($this->component->colorClasses, 'hover'))->toBe(data_get($pack2, 'class.hover'));
    expect(data_get($this->component->colorClasses, 'focus'))->toBe(data_get($pack3, 'class.focus'));
});

test('it should set hover and focus with color and variant', function () {
    $pack = $this->getVariantRandomPack(Variant::class, 'color', [Color::NONE]);
    $pack2 = $this->getVariantRandomPack(Variant::class, 'color', [Color::NONE]);
    $pack3 = $this->getVariantRandomPack(Variant::class, 'color', [Color::NONE]);

    $variant2 = data_get($pack2, 'variant');
    $variant3 = data_get($pack3, 'variant');

    $this->setAttributes($this->component, [
        'color' => data_get($pack, 'key'),
        'variant' => data_get($pack, 'variant'),
        "hover:{$variant2}" => data_get($pack2, 'key'),
        "focus:{$variant3}" => data_get($pack3, 'key'),
    ]);

    $this->invokeMethod($this->component, 'mountVariant');
    $this->invokeMethod($this->component, 'mountColor');
    $this->invokeMethod($this->component, 'mountStateColor');

    expect($this->component->color)->toBe(data_get($pack, 'key'));
    expect($this->component->variant)->toBe(data_get($pack, 'variant'));

    expect(data_get($this->component->colorClasses, 'base'))->toBe(data_get($pack, 'class.base'));
    expect(data_get($this->component->colorClasses, 'hover'))->toBe(data_get($pack2, 'class.hover'));
    expect(data_get($this->component->colorClasses, 'focus'))->toBe(data_get($pack3, 'class.focus'));
});
