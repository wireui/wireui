<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\View\ComponentAttributeBag;
use WireUi\Components\Button\Base as Button;

beforeEach(function () {
    $this->component = (new Button)->withName('button');

    $this->invokeMethod($this->component, 'setConfig');
});

test('it should setup simple spinner', function () {
    $this->setAttributes($this->component, [
        'spinner' => true,
    ]);

    $data = $this->component->data();

    $this->invokeMethod($this->component, 'mountSpinner', [&$data]);

    $spinner = data_get($data, 'spinner');
    $attributes = data_get($data, 'attributes');
    $spinnerRemove = data_get($data, 'spinnerRemove');

    expect($attributes->has('spinner'))->toBeFalse();

    expect($spinner)->toBeInstanceOf(ComponentAttributeBag::class);
    expect($spinnerRemove)->toBeInstanceOf(ComponentAttributeBag::class);

    expect($spinner->has('wire:loading'))->toBeTrue();
    expect($spinner->get('wire:loading'))->toBe('true');

    expect($spinnerRemove->has('wire:loading.remove'))->toBeTrue();
    expect($spinnerRemove->get('wire:loading.remove'))->toBe('true');
});

test('it should setup simple spinner with default delay', function () {
    $this->setAttributes($this->component, [
        'spinner.delay' => true,
    ]);

    $data = $this->component->data();

    $this->invokeMethod($this->component, 'mountSpinner', [&$data]);

    $spinner = data_get($data, 'spinner');
    $attributes = data_get($data, 'attributes');
    $spinnerRemove = data_get($data, 'spinnerRemove');

    expect($attributes->has('spinner.delay'))->toBeFalse();

    expect($spinner)->toBeInstanceOf(ComponentAttributeBag::class);
    expect($spinnerRemove)->toBeInstanceOf(ComponentAttributeBag::class);

    expect($spinner->has('wire:loading.delay'))->toBeTrue();
    expect($spinner->get('wire:loading.delay'))->toBe('true');

    expect($spinnerRemove->has('wire:loading.remove'))->toBeTrue();
    expect($spinnerRemove->get('wire:loading.remove'))->toBe('true');
});

test('it should setup simple spinner with delay', function () {
    $this->setAttributes($this->component, [
        'spinner.longest' => true,
    ]);

    $data = $this->component->data();

    $this->invokeMethod($this->component, 'mountSpinner', [&$data]);

    $spinner = data_get($data, 'spinner');
    $attributes = data_get($data, 'attributes');
    $spinnerRemove = data_get($data, 'spinnerRemove');

    expect($attributes->has('spinner.longest'))->toBeFalse();

    expect($spinner)->toBeInstanceOf(ComponentAttributeBag::class);
    expect($spinnerRemove)->toBeInstanceOf(ComponentAttributeBag::class);

    expect($spinner->has('wire:loading.delay.longest'))->toBeTrue();
    expect($spinner->get('wire:loading.delay.longest'))->toBe('true');

    expect($spinnerRemove->has('wire:loading.remove'))->toBeTrue();
    expect($spinnerRemove->get('wire:loading.remove'))->toBe('true');
});

test('it should setup spinner with target', function () {
    $this->setAttributes($this->component, [
        'spinner' => 'sleeping',
    ]);

    $data = $this->component->data();

    $this->invokeMethod($this->component, 'mountSpinner', [&$data]);

    $spinner = data_get($data, 'spinner');
    $attributes = data_get($data, 'attributes');
    $spinnerRemove = data_get($data, 'spinnerRemove');

    expect($attributes->has('spinner'))->toBeFalse();

    expect($spinner)->toBeInstanceOf(ComponentAttributeBag::class);
    expect($spinnerRemove)->toBeInstanceOf(ComponentAttributeBag::class);

    expect($spinner->has('wire:target'))->toBeTrue();
    expect($spinner->get('wire:target'))->toBe('sleeping');
    expect($spinner->has('wire:loading'))->toBeTrue();
    expect($spinner->get('wire:loading'))->toBe('true');

    expect($spinnerRemove->has('wire:loading.remove'))->toBeTrue();
    expect($spinnerRemove->get('wire:loading.remove'))->toBe('true');
    expect($spinnerRemove->has('wire:target'))->toBeTrue();
    expect($spinnerRemove->get('wire:target'))->toBe('sleeping');
});

test('it should setup spinner with target and delay', function () {
    $this->setAttributes($this->component, [
        'spinner.longest' => 'sleeping',
    ]);

    $data = $this->component->data();

    $this->invokeMethod($this->component, 'mountSpinner', [&$data]);

    $spinner = data_get($data, 'spinner');
    $attributes = data_get($data, 'attributes');
    $spinnerRemove = data_get($data, 'spinnerRemove');

    expect($attributes->has('spinner.longest'))->toBeFalse();

    expect($spinner)->toBeInstanceOf(ComponentAttributeBag::class);
    expect($spinnerRemove)->toBeInstanceOf(ComponentAttributeBag::class);

    expect($spinner->has('wire:target'))->toBeTrue();
    expect($spinner->get('wire:target'))->toBe('sleeping');
    expect($spinner->has('wire:loading.delay.longest'))->toBeTrue();
    expect($spinner->get('wire:loading.delay.longest'))->toBe('true');

    expect($spinnerRemove->has('wire:loading.remove'))->toBeTrue();
    expect($spinnerRemove->get('wire:loading.remove'))->toBe('true');
    expect($spinnerRemove->has('wire:target'))->toBeTrue();
    expect($spinnerRemove->get('wire:target'))->toBe('sleeping');
});
