<?php

namespace WireUi\Components\Badge\tests\Unit;

use WireUi\Components\Label\Base as Label;

beforeEach(function () {
    $this->component = (new Label)->withName('label');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'text' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'text',
    ]);
});

test('it should set specific text in component', function () {
    $this->setAttributes($this->component, [
        'text' => $text = fake()->word(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->text)->toBe($text);

    expect('<x-label :$text />')->render(compact('text'))->toContain($text);
});
