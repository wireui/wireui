<?php

namespace Tests\Unit\Traits\Components;

use WireUi\View\Components\Button\Base;

beforeEach(function () {
    $this->component = (new Base())->withName('button');
});

test('it should have config name', function () {
    $this->invokeMethod($this->component, 'setConfig');

    expect($this->invokeProperty($this->component, 'config'))->toBe('button');
});

test('it should have all properties empty', function () {
    expect($this->component->tag)->toBeNull();
});

test('it should execute base component type button', function () {
    $this->runWireUiComponent($this->component);

    $data = $this->component->data();

    expect($this->component->tag)->toBe('button');

    expect($this->component->wireLoadEnabled)->toBeFalse();

    expect($data['attributes']->get('type'))->toBe('button');
});

test('it should execute base component type link', function () {
    $this->setAttributes($this->component, [
        'href' => fake()->url(),
    ]);

    $this->runWireUiComponent($this->component);

    $data = $this->component->data();

    expect($this->component->tag)->toBe('a');

    expect($this->component->wireLoadEnabled)->toBeFalse();

    expect($data['attributes']->has('type'))->toBeFalse();
});

test('it should execute base component with loading', function () {
    $this->setAttributes($this->component, [
        'wire-load-enabled' => true,
    ]);

    $this->runWireUiComponent($this->component);

    $data = $this->component->data();

    expect($this->component->wireLoadEnabled)->toBeTrue();

    expect($data['attributes']->get('wire:loading.attr'))->toBe('disabled');

    expect($data['attributes']->get('wire:loading.class'))->toBe('!cursor-wait');
});
