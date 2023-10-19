<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\View\ComponentAttributeBag;
use WireUi\View\Components\Input\Number;

beforeEach(function () {
    $this->component = new Number();

    $this->component->componentName = 'number';
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['shadow']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe(['icon' => 'minus', 'right-icon' => 'plus']);
});

test('it should not have properties created', function () {
    expect(property_exists($this->component, 'icon'))->toBeFalse();

    expect(property_exists($this->component, 'shadow'))->toBeFalse();

    expect(property_exists($this->component, 'rightIcon'))->toBeFalse();

    expect(property_exists($this->component, 'shadowClasses'))->toBeFalse();
});

test('it should have properties created', function () {
    $this->component->attributes = new ComponentAttributeBag([
        'shadow' => 'md',
        'icon'   => 'plus',
    ]);

    $this->invokeMethod($this->component, 'setConfig');

    $this->invokeMethod($this->component, 'setupProps');

    expect(property_exists($this->component, 'icon'))->toBeTrue();

    expect(property_exists($this->component, 'shadow'))->toBeTrue();

    expect(property_exists($this->component, 'rightIcon'))->toBeTrue();

    expect(property_exists($this->component, 'shadowClasses'))->toBeTrue();
});

test('it should serialize props', function () {
    $serialized = $this->invokeMethod($this->component, 'serialize', ['key', 'value']);

    expect($serialized)->toBe(['key', 'value']);

    $serialized = $this->invokeMethod($this->component, 'serialize', [0, 'value']);

    expect($serialized)->toBe(['value', null]);
});
