<?php

namespace WireUi\Components\Alert\tests\Unit;

use WireUi\Components\Errors\Multiple as Errors;

beforeEach(function () {
    $this->withViewErrors([
        'first' => 'first error',
        'second' => 'second error',
        'third' => 'third error',
    ]);

    $this->component = (new Errors)->withName('errors');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'only' => [],
        'title' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'only',
        'title',
    ]);

    expect($this->component->only)->toBeEmpty();
});

test('it should set specific title in component', function () {
    $this->setAttributes($this->component, [
        'title' => $title = fake()->sentence(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->title)->toBe($title);

    expect('<x-errors :$title />')->render(compact('title'))->toContain($title);
});

test('it should filter only specific errors', function () {
    $this->setAttributes($this->component, [
        'only' => $only = ['first', 'second'],
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->only->toArray())->toBe($only);

    expect('<x-errors :$only />')
        ->render(compact('only'))
        ->not->toContain('third error')
        ->toContain('first error', 'second error');
});
