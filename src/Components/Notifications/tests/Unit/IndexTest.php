<?php

namespace WireUi\Components\Notifications\tests\Unit;

use WireUi\Components\Notifications\Index as Notifications;
use WireUi\Components\Notifications\WireUi\Position;

beforeEach(function () {
    $this->component = (new Notifications)->withName('notifications');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['position']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'z-index' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'zIndex',
        // Packs
        'position',
        'positionClasses',
    ]);
});

test('it should set random position in component', function () {
    $pack = $this->getRandomPack(Position::class);

    $this->setAttributes($this->component, [
        'position' => $position = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->position)->toBe($position);
    expect($this->component->positionClasses)->toBe($class);

    expect('<x-notifications :$position />')->render(compact('position'))->toContain($class);
});

test('it should set random z-index in component', function () {
    $this->setAttributes($this->component, [
        'z-index' => $zIndex = fake()->randomElement(['z-10', 'z-20', 'z-30', 'z-40', 'z-50']),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->zIndex)->toBe($zIndex);

    expect('<x-notifications :$zIndex />')->render(compact('zIndex'))->toContain($zIndex);
});
