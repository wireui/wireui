<?php

namespace WireUi\Components\Select\tests\Unit;

use WireUi\Components\Select\Native as NativeSelect;
use WireUi\Components\Wrapper\WireUi\Color;
use WireUi\Components\Wrapper\WireUi\Rounded;
use WireUi\WireUi\Shadow;

beforeEach(function () {
    $this->component = (new NativeSelect)->withName('native-select');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe([]);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'options' => null,
        'placeholder' => null,
        'flip-options' => false,
        'option-value' => null,
        'option-label' => null,
        'empty-message' => null,
        'option-key-value' => false,
        'hide-empty-message' => false,
        'option-description' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'options',
        'flipOptions',
        'optionValue',
        'optionLabel',
        'placeholder',
        'emptyMessage',
        'optionKeyValue',
        'hideEmptyMessage',
        'optionDescription',
    ]);

    expect($this->component->flipOptions)->toBeFalse();
    expect($this->component->optionKeyValue)->toBeFalse();
    expect($this->component->hideEmptyMessage)->toBeFalse();
});

test('it should set random color in component', function () {
    $pack = $this->getRandomPack(Color::class);

    $this->setAttributes($this->component, [
        'color' => $color = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect('<x-native-select :$color />')
        ->render(compact('color'))
        ->toContain(data_get($class, 'input'));
});

test('it should set random shadow in component', function () {
    $pack = $this->getRandomPack(Shadow::class);

    $this->setAttributes($this->component, [
        'shadow' => $shadow = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    expect('<x-native-select :$shadow />')
        ->render(compact('shadow'))
        ->toContain(data_get($pack, 'class'));
});

test('it should set random rounded in component', function () {
    $pack = $this->getRandomPack(Rounded::class);

    $this->setAttributes($this->component, [
        'rounded' => $rounded = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect('<x-native-select :$rounded />')
        ->render(compact('rounded'))
        ->toContain(data_get($class, 'input'));
});
