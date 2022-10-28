<?php

use Illuminate\View\{ComponentAttributeBag, ComponentSlot};
use WireUi\View\Components\Inputs\SliderInput;

it('should return the view as the chosen type', function () {
    $class = new SliderInput();

    $input = new ReflectionClass($class);

    $method = $input->getMethod('getView');

    $method->setAccessible(true);

    expect($method->invokeArgs($class, []))->toBe('wireui::components.inputs.slider.index');

    $class = new SliderInput(range: true);

    $method = $input->getMethod('getView');

    $method->setAccessible(true);

    expect($method->invokeArgs($class, []))->toBe('wireui::components.inputs.slider.range');
});

it('should format the data for the input number when using range', function () {
    $class = new SliderInput();

    $min = new ComponentSlot('', ['wire:model' => 'value.0']);

    expect($class->formatDataSliderRange($min)->getAttributes())->toBe([
        'wire:model' => 'value.0',
        'name'       => 'value.0',
        'id'         => md5('value.0'),
        'disabled'   => null,
        'readonly'   => null,
    ]);

    $max = new ComponentSlot('', ['wire:model' => 'value.1']);

    expect($class->formatDataSliderRange($max)->getAttributes())->toBe([
        'wire:model' => 'value.1',
        'name'       => 'value.1',
        'id'         => md5('value.1'),
        'disabled'   => null,
        'readonly'   => null,
    ]);
});

it('should format the data for the input number', function () {
    $class = new SliderInput();

    $attributes = new ComponentAttributeBag();

    expect($class->formatDataSlider($attributes))->toBe([
        'type' => 'number',
        'min'  => 0,
        'max'  => 100,
        'step' => 1,
    ]);

    $attributes = new ComponentAttributeBag(['min' => 50, 'max' => 51, 'step' => 0.01]);

    expect($class->formatDataSlider($attributes))->toBe([
        'type' => 'number',
        'min'  => 50,
        'max'  => 51,
        'step' => 0.01,
    ]);
});

it('should return the slider classes according to the data passed', function () {
    $class = new SliderInput();

    expect($class->getSliderClasses())
        ->toBe('relative w-full align-middle bg-secondary-200 rounded dark:bg-white cursor-pointer my-4 h-1.5');

    expect($class->getSliderClasses(true))
        ->toBe('relative w-full align-middle bg-secondary-200 rounded dark:bg-white my-4 h-1.5');

    $class = new SliderInput(md: true);

    expect($class->getSliderClasses())
        ->toBe('relative w-full align-middle bg-secondary-200 rounded dark:bg-white cursor-pointer my-4.5 h-2');

    expect($class->getSliderClasses(true))
        ->toBe('relative w-full align-middle bg-secondary-200 rounded dark:bg-white my-4.5 h-2');

    $class = new SliderInput(lg: true);

    expect($class->getSliderClasses())
        ->toBe('relative w-full align-middle bg-secondary-200 rounded dark:bg-white cursor-pointer my-5 h-2.5');

    expect($class->getSliderClasses(true))
        ->toBe('relative w-full align-middle bg-secondary-200 rounded dark:bg-white my-5 h-2.5');
});

it('should return the bar classes according to the data passed', function () {
    $class = new SliderInput();

    expect($class->getBarClasses())
        ->toBe('absolute rounded-l bg-primary-600 h-1.5');

    expect($class->getBarClasses(true))
        ->toBe('absolute rounded-l bg-secondary-500 opacity-60 h-1.5');

    expect($class->getBarClasses(false, true))
        ->toBe('absolute rounded-l bg-negative-600 h-1.5');

    $class = new SliderInput(md: true);

    expect($class->getBarClasses())
        ->toBe('absolute rounded-l bg-primary-600 h-2');

    $class = new SliderInput(lg: true);

    expect($class->getBarClasses())
        ->toBe('absolute rounded-l bg-primary-600 h-2.5');
});

it('should return the stop classes according to the data passed', function () {
    $class = new SliderInput();

    expect($class->getStopClasses())
        ->toBe('absolute -translate-x-1/2 bg-white rounded-full dark:bg-secondary-400 w-1.5 h-1.5');

    $class = new SliderInput(md: true);

    expect($class->getStopClasses())
        ->toBe('absolute -translate-x-1/2 bg-white rounded-full dark:bg-secondary-400 w-2 h-2');

    $class = new SliderInput(lg: true);

    expect($class->getStopClasses())
        ->toBe('absolute -translate-x-1/2 bg-white rounded-full dark:bg-secondary-400 w-2.5 h-2.5');
});

it('should return the button grid classes', function () {
    $class = new SliderInput();

    expect($class->getButtonGridClasses())
        ->toBe(<<<EOT
            absolute leading-normal text-center -translate-x-1/2
            bg-transparent select-none w-9 h-9 -top-4 z-10
        EOT);
});

it('should return the button classes according to the data passed', function () {
    $class = new SliderInput();

    expect($class->getButtonClasses())
        ->toBe(<<<EOT
            border-2 bg-white hover:bg-white dark:hover:bg-white
            cursor-grab hover:scale-120
        EOT);

    expect($class->getButtonClasses(true))
        ->toBe(<<<EOT
            border-2 bg-white hover:bg-white dark:hover:bg-white
            ring-transparent cursor-not-allowed
        EOT);
});

it('should return the button color', function () {
    $class = new SliderInput();

    expect($class->buttonError())->toBe('primary');

    expect($class->buttonError(true))->toBe('secondary');

    expect($class->buttonError(false, true))->toBe('negative');
});

it('should return the button size', function () {
    $class = new SliderInput();

    expect($class->buttonSizes())->toBe('2xs');

    $class = new SliderInput(md: true);

    expect($class->buttonSizes())->toBe('xs');

    $class = new SliderInput(lg: true);

    expect($class->buttonSizes())->toBe('sm');
});
