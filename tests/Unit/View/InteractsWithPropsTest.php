<?php

namespace Tests\Unit\View;

use WireUi\Components\Alert\Index as Alert;

beforeEach(function () {
    $this->component = (new Alert)->withName('alert');

    $this->invokeMethod($this->component, 'setConfig');
});

test('it should manage props', function () {
    $this->setAttributes($this->component, []);

    $data = $this->component->data();

    expect($this->component)->not->toHaveProperty('icon');

    $this->invokeMethod($this->component, 'manageProps', ['icon', null, $data]);

    expect($this->component->icon)->toBeNull();
    expect($this->component)->toHaveProperty('icon');

    $this->invokeMethod($this->component, 'manageProps', ['icon', 'bell', $data]);

    expect($this->component->icon)->toBe('bell');
    expect($this->component)->toHaveProperty('icon');
});

test('it should manage packs', function () {
    $this->setAttributes($this->component, []);

    expect($this->component)->not->toHaveProperty('shadow');
    expect($this->component)->not->toHaveProperty('shadowClasses');

    $this->invokeMethod($this->component, 'managePacks', ['shadow']);

    expect($this->component->shadow)->toBeNull();
    expect($this->component->shadowClasses)->toBe('shadow');
    expect($this->component)->toHaveProperties(['shadow', 'shadowClasses']);

    $this->setAttributes($this->component, ['shadow' => 'md']);

    $this->invokeMethod($this->component, 'managePacks', ['shadow']);

    expect($this->component->shadow)->toBe('md');
    expect($this->component->shadowClasses)->toBe('shadow-md');
    expect($this->component)->toHaveProperties(['shadow', 'shadowClasses']);
});

test('it should setup props', function () {
    $this->setAttributes($this->component, []);

    $data = $this->component->data();

    expect($this->component)->not->toHaveProperties(['icon', 'shadow', 'shadowClasses']);

    $this->invokeMethod($this->component, 'mountProps', [$data]);

    expect($this->component)->toHaveProperties(['icon', 'shadow', 'shadowClasses']);
});
