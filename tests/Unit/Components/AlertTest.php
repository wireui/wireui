<?php

use Illuminate\Support\Facades\Blade;

it('should render the alert slot', function () {
    $html = Blade::render('<x-alert><b>Text From Slot</b></x-alert>');

    expect($html)->toContain('<b>Text From Slot</b>');
});

it('should render the alert with default border', function () {
    $html = Blade::render('<x-alert border message="This is message"/>');

    expect($html)->toContain('border border-gray-300 dark:border-secondary-600');
});

it('should render the alert with custom classes', function () {
    $html = Blade::render('<x-alert alertClasses="mt-2 mb-2" message="This is message"/>');

    expect($html)->toContain('mt-2 mb-2');
});

it('should render the alert with shadow', function () {
    $html = Blade::render('<x-alert shadow message="This is message"/>');

    expect($html)->toContain('shadow-md');
});
