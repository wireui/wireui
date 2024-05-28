<?php

namespace WireUi\Components\Dialog\tests\Unit;

use WireUi\Components\Dialog\Index as Dialog;

beforeEach(function () {
    $this->component = (new Dialog())->withName('dialog');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['align', 'blur', 'width', 'type']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'id'          => null,
        'title'       => null,
        'spacing'     => null,
        'z-index'     => null,
        'blurless'    => false,
        'description' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        'id',
        'blur',
        'type',
        'align',
        'title',
        'width',
        'zIndex',
        'spacing',
        'blurless',
        'blurClasses',
        'description',
        'typeClasses',
        'alignClasses',
        'widthClasses',
    ]);

    expect($this->component->blurless)->toBeFalse();
    expect($this->component->dialog)->toBe('dialog');
});

// test('it should not have properties in component', function () {
//     expect($this->component)->not->toHaveProperties([
//         'colors',
//         'shadow',
//         'rightIcon',
//         'shadowless',
//         'shadowClasses',
//         'colorNameAsValue',
//     ]);
// });
