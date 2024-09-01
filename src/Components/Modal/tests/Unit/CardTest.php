<?php

namespace WireUi\Components\Modal\tests\Unit;

use WireUi\Components\Modal\Card as ModalCard;

beforeEach(function () {
    $this->component = (new ModalCard)->withName('modal-card');
});

test('it should have array properties', function () {
    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'persistent' => false,
        'spacing' => null,
        'fullscreen' => false,
        'hide-close' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'persistent',
        'spacing',
        'hideClose',
        'fullscreen',
    ]);

    expect($this->component->hideClose)->toBeFalse();
    expect($this->component->fullscreen)->toBeFalse();
});

test('it should set modal card as fullscreen', function () {
    $this->setAttributes($this->component, [
        'fullscreen' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->fullscreen)->toBeTrue();

    expect('<x-modal-card fullscreen />')->render()->toContain('p-0', 'w-full min-h-screen');
});

test('it should hide close in modal card', function () {
    $this->setAttributes($this->component, [
        'hide-close' => true,
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->hideClose)->toBeTrue();

    expect('<x-modal-card title="Title" hide-close />')->render()->not->toContain('button');
});
