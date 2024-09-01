<?php

namespace Tests\Unit\Traits\Components;

use WireUi\Components\Button\Base as Button;
use WireUi\Components\Button\WireUi\Size\Base as Size;
use WireUi\Enum\Packs\Size as SizePack;

beforeEach(function () {
    $this->component = (new Button)->withName('button');

    $this->invokeMethod($this->component, 'setConfig');
});

test('it should setup size', function () {
    $sizePack = resolve(Size::class);

    $this->setAttributes($this->component, [
        'size' => $size = SizePack::XL2,
    ]);

    $this->invokeMethod($this->component, 'mountSize');

    expect($this->component->size)->toBe($size);
    expect($this->component->sizeClasses)->toBe($sizePack->get($size));

    $this->setAttributes($this->component, [
        'size' => $size = 'gap-x-[5px] text-xs px-[5px] py-[5px]',
    ]);

    $this->invokeMethod($this->component, 'mountSize');

    expect($this->component->size)->toBe($size);
    expect($this->component->sizeClasses)->toBe($size);
});
