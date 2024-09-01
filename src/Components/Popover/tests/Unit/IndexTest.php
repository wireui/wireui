<?php

namespace WireUi\Components\Popover\tests\Unit;

use WireUi\Components\Popover\Index as Popover;

beforeEach(function () {
    $this->component = (new Popover)->withName('popover');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'margin' => false,
        'root-class' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'margin',
        'rootClass',
    ]);

    expect($this->component->margin)->toBeFalse();
});

test('it should set custom root class in component with slot', function () {
    $this->setAttributes($this->component, [
        'root-class' => $rootClass = fake()->slug(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->rootClass)->toBe($rootClass);

    expect(<<<'EOT'
    <x-popover :$rootClass>
        Popover Slot
    </x-popover>
    EOT)->render(compact('rootClass'))->toContain($rootClass, 'Popover Slot');
});
