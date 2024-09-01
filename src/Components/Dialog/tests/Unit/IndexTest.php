<?php

namespace WireUi\Components\Dialog\tests\Unit;

use WireUi\Components\Dialog\Index as Dialog;
use WireUi\Components\Modal\WireUi\Align;
use WireUi\Components\Modal\WireUi\Blur;
use WireUi\Components\Modal\WireUi\Type;
use WireUi\Components\Modal\WireUi\Width;

beforeEach(function () {
    $this->component = (new Dialog)->withName('dialog');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe(['align', 'blur', 'width', 'type']);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'id' => null,
        'title' => null,
        'spacing' => null,
        'z-index' => null,
        'blurless' => false,
        'description' => null,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'id',
        'title',
        'zIndex',
        'spacing',
        'blurless',
        'description',
        // Packs
        'blur',
        'type',
        'align',
        'width',
        'blurClasses',
        'description',
        'typeClasses',
        'alignClasses',
        'widthClasses',
    ]);

    expect($this->component->blurless)->toBeFalse();
    expect($this->component->dialog)->toBe('dialog');
});

test('it should set a custom id in component', function () {
    $this->setAttributes($this->component, [
        'id' => $id = fake()->slug(),
    ]);

    $this->runWireUiComponent($this->component);

    expect($this->component->id)->toBe($id);
    expect($this->component->dialog)->toBe("dialog:{$id}");
});

test('it should set random align in component', function () {
    $pack = $this->getRandomPack(Align::class);

    $this->setAttributes($this->component, [
        'align' => $align = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->align)->toBe($align);
    expect($this->component->alignClasses)->toBe($class);

    expect('<x-dialog :$align />')->render(compact('align'))->toContain($class);
});

test('it should set random blur in component', function () {
    $pack = $this->getRandomPack(Blur::class);

    $this->setAttributes($this->component, [
        'blur' => $blur = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->blur)->toBe($blur);
    expect($this->component->blurClasses)->toBe($class);

    expect('<x-dialog :$blur />')->render(compact('blur'))->toContain($class);
});

test('it should set random width in component', function () {
    $pack = $this->getRandomPack(Width::class);

    $this->setAttributes($this->component, [
        'width' => $width = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->width)->toBe($width);
    expect($this->component->widthClasses)->toBe($class);

    expect('<x-dialog :$width />')->render(compact('width'))->toContain($class);
});

test('it should set random type in component', function () {
    $pack = $this->getRandomPack(Type::class);

    $this->setAttributes($this->component, [
        'z-index' => $zIndex = null,
        'type' => $type = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->type)->toBe($type);
    expect($this->component->typeClasses)->toBe($class);

    expect('<x-dialog :$type :$zIndex />')->render(compact('type', 'zIndex'))->toContain(...[
        data_get($pack, 'class.z-index'),
        data_get($pack, 'class.spacing'),
    ]);
});
