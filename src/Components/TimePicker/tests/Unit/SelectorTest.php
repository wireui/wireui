<?php

namespace WireUi\Components\TimePicker\tests\Unit;

use WireUi\Components\TimePicker\Selector as TimeSelector;
use WireUi\WireUi\Rounded;
use WireUi\WireUi\Shadow;

beforeEach(function () {
    $this->component = (new TimeSelector)->withName('time-selector');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['shadow']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'borderless' => false,
        'shadowless' => false,
        'military-time' => false,
        'without-seconds' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'borderless',
        'shadowless',
        'militaryTime',
        'withoutSeconds',
        // Packs
        'shadow',
        'rounded',
        'squared',
        'shadowClasses',
        'roundedClasses',
    ]);

    expect($this->component->borderless)->toBeFalse();
    expect($this->component->shadowless)->toBeFalse();
    expect($this->component->militaryTime)->toBeFalse();
    expect($this->component->withoutSeconds)->toBeFalse();
});

test('it should set random shadow in component', function () {
    $pack = $this->getRandomPack(Shadow::class);

    $this->setAttributes($this->component, [
        'shadow' => $shadow = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->shadow)->toBe($shadow);
    expect($this->component->shadowless)->toBeFalse();
    expect($this->component->shadowClasses)->toBe($class);

    expect('<x-time-selector :$shadow />')->render(compact('shadow'))->toContain($class);
});

test('it should set random rounded in component', function () {
    $pack = $this->getRandomPack(Rounded::class);

    $this->setAttributes($this->component, [
        'rounded' => $rounded = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->squared)->toBeFalse();
    expect($this->component->rounded)->toBe($rounded);
    expect($this->component->roundedClasses)->toBe($class);

    expect('<x-time-selector :$rounded />')
        ->render(compact('rounded'))
        ->toContain(data_get($class, 'input'));
});
