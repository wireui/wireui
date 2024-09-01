<?php

namespace Tests\Unit\Support;

use WireUi\Components\Button\Base;
use WireUi\Support\ComponentResolver;

beforeEach(function () {
    $this->resolver = new ComponentResolver;
});

test('it should resolve the component', function () {
    $component = $this->resolver->resolve('button');

    expect($component)->toBe('button');

    config(['wireui.prefix' => 'wire:']);

    $component = $this->resolver->resolve('button');

    expect($component)->toBe('wire:button');
});

test('it should resolve the component class', function () {
    $component = $this->resolver->resolveClass('button');

    expect($component)->toBe(Base::class);

    config(['wireui.prefix' => 'wire:']);

    $component = $this->resolver->resolveClass('wire:button');

    expect($component)->toBe(Base::class);
});

test('it should resolve the component by alias', function () {
    $component = $this->resolver->resolveByAlias('button');

    expect($component)->toBe('button');

    config(['wireui.prefix' => 'wire:']);

    $component = $this->resolver->resolveByAlias('wire:button');

    expect($component)->toBe('button');
});

test('it should add the prefix', function () {
    $component = $this->resolver->addPrefix('button');

    expect($component)->toBe('button');

    config(['wireui.prefix' => 'wire:']);

    $component = $this->resolver->addPrefix('button');

    expect($component)->toBe('wire:button');
});

test('it should remove the prefix', function () {
    $component = $this->resolver->removePrefix('button');

    expect($component)->toBe('button');

    config(['wireui.prefix' => 'wire:']);

    $component = $this->resolver->removePrefix('wire:button');

    expect($component)->toBe('button');
});
