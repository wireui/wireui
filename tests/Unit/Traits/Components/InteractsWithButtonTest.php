<?php

namespace Tests\Unit\Traits\Components;

use WireUi\Components\Button\Base as Button;

beforeEach(function () {
    $this->component = (new Button)->withName('button');
});

test('it should have all properties empty', function () {
    expect($this->component->tag)->toBeNull();
});

test('it should get tag button', function () {
    $this->setAttributes($this->component, []);

    $tag = $this->invokeMethod($this->component, 'getTag');

    expect($tag)->toBe('button');

    $this->setAttributes($this->component, [
        'href' => fake()->url(),
    ]);

    $tag = $this->invokeMethod($this->component, 'getTag');

    expect($tag)->toBe('a');
});

test('it should ensure link type', function () {
    $this->setAttributes($this->component, []);

    $this->invokeMethod($this->component, 'ensureLinkType');

    expect($this->component->attributes->get('type'))->toBe('button');

    $this->setAttributes($this->component, [
        'href' => fake()->url(),
    ]);

    $this->invokeMethod($this->component, 'ensureLinkType');

    expect($this->component->attributes->has('type'))->toBeFalse();

    $this->setAttributes($this->component, [
        'type' => 'submit',
    ]);

    $this->invokeMethod($this->component, 'ensureLinkType');

    expect($this->component->attributes->get('type'))->toBe('submit');
});

test('it should ensure wire loading', function () {
    $this->setAttributes($this->component, []);

    $this->invokeMethod($this->component, 'ensureWireLoading');

    expect($this->component->attributes->has('wire:loading.attr'))->toBeFalse();
    expect($this->component->attributes->has('wire:loading.class'))->toBeFalse();

    $this->component->wireLoadEnabled = true;

    $this->invokeMethod($this->component, 'ensureWireLoading');

    expect($this->component->attributes->get('wire:loading.attr'))->toBe('disabled');
    expect($this->component->attributes->get('wire:loading.class'))->toBe('!cursor-wait');
});

test('it should setup button', function () {
    $this->setAttributes($this->component, []);

    $this->invokeMethod($this->component, 'mountButton');

    expect($this->component->tag)->toBe('button');

    $this->setAttributes($this->component, [
        'href' => fake()->url(),
    ]);

    $this->invokeMethod($this->component, 'mountButton');

    expect($this->component->tag)->toBe('a');
});
