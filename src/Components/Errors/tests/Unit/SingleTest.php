<?php

namespace WireUi\Components\Alert\tests\Unit;

use WireUi\Components\Errors\Single as Error;

beforeEach(function () {
    $this->withViewErrors([
        'test' => 'test error',
    ]);

    $this->component = (new Error)->withName('error');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'name' => null,
        'message' => null,
        'invalidated' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->setAttributes($this->component, [
        'name' => $name = 'test',
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'name',
        'message',
        'invalidated',
    ]);

    expect($this->component->name)->toBe($name);
    expect($this->component->invalidated)->toBeTrue();
    expect($this->component->message)->toBe('test error');
});

test('it should set specific name in component', function () {
    $this->setAttributes($this->component, [
        'name' => $name = 'test',
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->name)->toBe($name);
    expect($this->component->invalidated)->toBeTrue();
    expect($this->component->message)->toBe('test error');

    expect('<x-errors :$name />')->render(compact('name'))->toContain('test error');
});
