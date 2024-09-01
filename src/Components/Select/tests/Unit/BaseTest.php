<?php

namespace WireUi\Components\Select\tests\Unit;

use WireUi\Components\Select\Base as Select;
use WireUi\Components\Wrapper\WireUi\Color;
use WireUi\Components\Wrapper\WireUi\Rounded;
use WireUi\WireUi\Shadow;

beforeEach(function () {
    $this->component = (new Select)->withName('select');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe([]);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'label' => null,
        'options' => null,
        'template' => null,
        'clearable' => true,
        'async-data' => null,
        'right-icon' => 'chevron-up-down',
        'searchable' => true,
        'multiselect' => false,
        'placeholder' => null,
        'always-fetch' => false,
        'flip-options' => false,
        'option-label' => null,
        'option-value' => null,
        'empty-message' => null,
        'option-key-value' => false,
        'hide-empty-message' => false,
        'option-description' => null,
        'without-items-count' => true,
        'min-items-for-search' => 11,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'options',
        'template',
        'asyncData',
        'clearable',
        'rightIcon',
        'searchable',
        'alwaysFetch',
        'flipOptions',
        'multiselect',
        'optionLabel',
        'optionValue',
        'placeholder',
        'emptyMessage',
        'optionKeyValue',
        'hideEmptyMessage',
        'minItemsForSearch',
        'optionDescription',
        'withoutItemsCount',
    ]);

    expect($this->component->clearable)->toBeTrue();
    expect($this->component->searchable)->toBeTrue();
    expect($this->component->multiselect)->toBeFalse();
    expect($this->component->alwaysFetch)->toBeFalse();
    expect($this->component->flipOptions)->toBeFalse();
    expect($this->component->optionKeyValue)->toBeFalse();
    expect($this->component->minItemsForSearch)->toBe(11);
    expect($this->component->hideEmptyMessage)->toBeFalse();
    expect($this->component->withoutItemsCount)->toBeTrue();
});

test('it should set random color in component', function () {
    $pack = $this->getRandomPack(Color::class);

    $this->setAttributes($this->component, [
        'color' => $color = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect('<x-select :$color />')
        ->render(compact('color'))
        ->toContain(data_get($class, 'input'));
});

test('it should set random shadow in component', function () {
    $pack = $this->getRandomPack(Shadow::class);

    $this->setAttributes($this->component, [
        'shadow' => $shadow = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    expect('<x-select :$shadow />')
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

    expect('<x-select :$rounded />')
        ->render(compact('rounded'))
        ->toContain(data_get($class, 'input'));
});
