<?php

namespace Tests\Unit\View;

use WireUi\Components\Button\Base as Button;
use WireUi\Components\Button\WireUi\IconSize;
use WireUi\Components\Button\WireUi\Size\Base as Size;
use WireUi\Enum\Packs\Size as SizePack;

beforeEach(function () {
    $this->component = (new Button)->withName('button');
});

test('it should check config name', function () {
    expect($this->component->config)->toBeNull();

    $this->invokeMethod($this->component, 'setConfig');

    expect($this->component->config)->toBeString()->toEqual('button');
});

test('it should get attribute in component', function () {
    $pack = $this->getRandomPack(IconSize::class);

    $this->invokeMethod($this->component, 'setConfig');

    $this->setAttributes($this->component, [
        'icon-size' => $size = data_get($pack, 'key'),
    ]);

    // kebab-case
    $data = $this->invokeMethod($this->component, 'getData', ['icon-size', null]);

    expect($data)->toBeString()->toEqual($size);

    // camelCase
    $data = $this->invokeMethod($this->component, 'getData', ['iconSize', null]);

    expect($data)->toBeString()->toEqual($size);

    // check icon-size
    $this->setAttributes($this->component, []);

    $this->component->size = 'w-[10px] h-[10px]';

    $data = $this->invokeMethod($this->component, 'getData', ['icon-size', null]);

    expect($data)->toBeString()->toEqual('w-[10px] h-[10px]');

    // check default
    $data = $this->invokeMethod($this->component, 'getData', ['size', null]);

    expect($data)->toBeString()->toEqual(SizePack::MD);
});

test('it should get attribute modifier in component', function () {
    $pack = $this->getRandomPack(Size::class);

    $this->invokeMethod($this->component, 'setConfig');

    $this->setAttributes($this->component, [
        'size' => $size = data_get($pack, 'key'),
    ]);

    // check if attribute exists
    $data = $this->invokeMethod($this->component, 'getDataModifier', ['size', resolve(Size::class)]);

    expect($data)->toBeString()->toEqual($size);

    // check if attribute modifier exists
    $this->setAttributes($this->component, [
        $size => true,
    ]);

    $data = $this->invokeMethod($this->component, 'getDataModifier', ['size', resolve(Size::class)]);

    expect($data)->toBeString()->toEqual($size);

    // check default
    $this->setAttributes($this->component, []);

    $data = $this->invokeMethod($this->component, 'getDataModifier', ['size', resolve(Size::class)]);

    expect($data)->toBeString()->toEqual(SizePack::MD);
});

test('it should get match modifier attribute in component', function () {
    $pack = $this->getRandomPack(Size::class);

    $size = data_get($pack, 'key');

    $this->setAttributes($this->component, [
        $size => true,
    ]);

    $data = $this->invokeMethod($this->component, 'getMatchModifier', [[$size]]);

    expect($data)->toBeString()->toEqual($size);
});

test('it should check if component use validation color', function () {
    $check = $this->invokeMethod($this->component, 'useValidation');

    expect($check)->toBeFalse();

    $this->component->useValidationColors = true;

    $check = $this->invokeMethod($this->component, 'useValidation');

    expect($check)->toBeTrue();
});
