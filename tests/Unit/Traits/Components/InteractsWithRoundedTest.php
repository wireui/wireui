<?php

namespace Tests\Unit\Traits\Components;

use WireUi\Components\Button\Base as Button;
use WireUi\Enum\Packs\Rounded as RoundedPack;
use WireUi\WireUi\Rounded;

beforeEach(function () {
    $this->component = (new Button)->withName('button');

    $this->invokeMethod($this->component, 'setConfig');
});

test('it should setup rounded', function () {
    $roundedPack = resolve(Rounded::class);

    $this->setAttributes($this->component, [
        'squared' => true,
        'rounded' => true,
    ]);

    $this->invokeMethod($this->component, 'mountRounded');

    expect($this->component->squared)->toBeTrue();
    expect($this->component->rounded)->toBeTrue();
    expect($this->component->roundedClasses)->toBe($roundedPack->get(RoundedPack::NONE));

    $this->setAttributes($this->component, [
        'squared' => false,
        'rounded' => true,
    ]);

    $this->invokeMethod($this->component, 'mountRounded');

    expect($this->component->rounded)->toBeTrue();
    expect($this->component->squared)->toBeFalse();
    expect($this->component->roundedClasses)->toBe($roundedPack->get(RoundedPack::FULL));

    $this->setAttributes($this->component, [
        'squared' => false,
        'rounded' => $rounded = RoundedPack::SM,
    ]);

    $this->invokeMethod($this->component, 'mountRounded');

    expect($this->component->squared)->toBeFalse();
    expect($this->component->rounded)->toBe($rounded);
    expect($this->component->roundedClasses)->toBe($roundedPack->get($rounded));

    $this->setAttributes($this->component, [
        'squared' => false,
        'rounded' => $rounded = 'rounded-md',
    ]);

    $this->invokeMethod($this->component, 'mountRounded');

    expect($this->component->squared)->toBeFalse();
    expect($this->component->rounded)->toBe($rounded);
    expect($this->component->roundedClasses)->toBe($roundedPack->get($rounded));
});
