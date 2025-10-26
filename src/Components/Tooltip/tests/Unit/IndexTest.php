<?php

namespace WireUi\Components\Tooltip\tests\Unit;

use WireUi\Components\Tooltip\Index;

beforeEach(function () {
    $this->component = (new Index)->withName('tooltip');
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        'text',
        'position',
        'timeout',
    ]);
});

test('it should set text to component', function () {
    $text = 'Tooltip text';

    $this->setAttributes($this->component, [
        'text' => $text,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->text)->toBe($text);
    expect('<x-tooltip :$text />')->render(compact('text'))->toContain($text);
});

test('it should set position to component', function () {
    $position = 'top';

    $this->setAttributes($this->component, [
        'position' => $position,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->position)->toBe($position);
});

test('it should set timeout to component', function () {
    $timeout = 500;

    $this->setAttributes($this->component, [
        'timeout' => $timeout,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->timeout)->toBe($timeout);
    expect('<x-tooltip :$timeout />')->render(compact('timeout'))->toContain("tooltipTimeout: $timeout");
});
