<?php

namespace Tests\Unit\Traits\Components;

use WireUi\Components\Button\Base as Button;
use WireUi\Components\Button\WireUi\Variant;

beforeEach(function () {
    $this->component = (new Button)->withName('button');

    $this->invokeMethod($this->component, 'setConfig');
});

test('it should setup variant', function () {
    $pack = $this->getRandomPack(Variant::class);

    $this->setAttributes($this->component, [
        'variant' => $variant = data_get($pack, 'key'),
    ]);

    $this->invokeMethod($this->component, 'mountVariant');

    expect($this->component->variant)->toBe($variant);
    expect($this->invokeProperty($this->component, 'variantPack'))->toBeInstanceOf(Variant::class);
    expect($this->invokeProperty($this->component, 'colorResolve'))->toBe(data_get($pack, 'class.color'));
});
