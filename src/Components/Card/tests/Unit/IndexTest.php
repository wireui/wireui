<?php

namespace WireUi\Components\Card\tests\Unit;

use WireUi\Components\Card\Index as Card;
use WireUi\Components\Card\WireUi\Rounded;
use WireUi\Enum\Packs;

beforeEach(function () {
    $this->component = (new Card)->withName('card');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['shadow', 'padding']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'title' => null,
        'borderless' => false,
        'shadowless' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'title',
        'borderless',
        'shadowless',
        // Packs
        'color',
        'shadow',
        'padding',
        'rounded',
        'squared',
        'colorClasses',
        'shadowClasses',
        'paddingClasses',
    ]);

    expect($this->component->borderless)->toBeFalse();
    expect($this->component->shadowless)->toBeFalse();
});

test('it should render title in component', function () {
    $this->setAttributes($this->component, [
        'title' => $title = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->title)->toBe($title);

    expect('<x-card :$title />')->render(compact('title'))->toContain($title);
});

test('it should set rounded full in component', function () {
    $this->setAttributes($this->component, [
        'rounded' => true,
    ]);

    $this->runWireUiComponent($this->component);

    $class = (new Rounded)->get(Packs\Rounded::FULL);

    expect($this->component->rounded)->toBeTrue();
    expect($this->component->squared)->toBeFalse();
    expect($this->component->roundedClasses)->toBe($class);

    expect(<<<'EOT'
    <x-card title="Title" rounded>
        <x-slot name="footer">Footer</x-slot>
    </x-card>
    EOT)->render()->toContain(...$class);
});

test('it should set squared in component', function () {
    $this->setAttributes($this->component, [
        'squared' => true,
    ]);

    $this->runWireUiComponent($this->component);

    $class = (new Rounded)->get(Packs\Rounded::NONE);

    expect($this->component->squared)->toBeTrue();
    expect($this->component->rounded)->toBeFalse();
    expect($this->component->roundedClasses)->toBe($class);

    expect(<<<'EOT'
    <x-card title="Title" squared>
        <x-slot name="footer">Footer</x-slot>
    </x-card>
    EOT)->render()->toContain(...$class);
});
