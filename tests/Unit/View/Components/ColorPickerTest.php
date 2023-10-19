<?php

namespace Tests\Unit\View\Components;

use WireUi\View\Components\ColorPicker;

it('can be instantiated with default parameters', function () {
    $colorPicker = new ColorPicker();

    expect($colorPicker->rightIcon)->toBe('swatch');
    expect($colorPicker->colors)->toBe([]);
    expect($colorPicker->colorNameAsValue)->toBe(false);
});

it('can be instantiated with custom parameters', function () {
    $colors      = collect(['red' => '#ff0000', 'green' => '#00ff00', 'blue' => '#0000ff']);
    $colorPicker = new ColorPicker('icon', $colors, true);

    expect($colorPicker->rightIcon)->toBe('icon');
    expect($colorPicker->colors)->toBe($colors);
    expect($colorPicker->colorNameAsValue)->toBe(true);
});

it('transforms colors correctly', function () {
    $colors      = ['red' => '#ff0000', 'green' => '#00ff00', '#0000ff'];
    $colorPicker = new ColorPicker(colors: $colors);

    $transformedColors = $colorPicker->getColors();

    expect($transformedColors)->toBe([
        ['name' => 'red', 'value' => '#ff0000'],
        ['name' => 'green', 'value' => '#00ff00'],
        ['name' => '#0000ff', 'value' => '#0000ff'],
    ]);
});

it('returns an empty array when no colors are provided', function () {
    $colorPicker = new ColorPicker();
    $colors      = $colorPicker->getColors();

    expect($colors)->toBe([]);
});

it('handles colors as string correctly', function () {
    $colors      = ['red', 'green', 'blue'];
    $colorPicker = new ColorPicker(colors: $colors);

    $expected = [
        ['name' => 'red', 'value' => 'red'],
        ['name' => 'green', 'value' => 'green'],
        ['name' => 'blue', 'value' => 'blue'],
    ];
    expect($colorPicker->getColors())->toBe($expected);
});

it('handles colors as associative array correctly', function () {
    $colors = [
        'red'   => '#ff0000',
        'green' => '#00ff00',
        'blue'  => '#0000ff',
    ];
    $colorPicker = new ColorPicker(colors: $colors);

    $expected = [
        ['name' => 'red', 'value' => '#ff0000'],
        ['name' => 'green', 'value' => '#00ff00'],
        ['name' => 'blue', 'value' => '#0000ff'],
    ];
    expect($colorPicker->getColors())->toBe($expected);
});

it('handles mixed types in colors array correctly', function () {
    $colors = [
        'red' => '#ff0000',
        '#00ff00',
        'blue' => '#0000ff',
    ];
    $colorPicker = new ColorPicker(colors: $colors);

    $expected = [
        ['name' => 'red', 'value' => '#ff0000'],
        ['name' => '#00ff00', 'value' => '#00ff00'],
        ['name' => 'blue', 'value' => '#0000ff'],
    ];
    expect($colorPicker->getColors())->toBe($expected);
});

it('should pass custom colors to js component data', function () {
    expect('<x-color-picker :colors="$colors" />')
        ->render(['colors' => [['name' => 'FFF', 'value' => '#FFF']]])
        ->toContain('colors:JSON.parse(atob(&#039;W3sibmFtZSI6IkZGRiIsInZhbHVlIjoiI0ZGRiJ9XQ==&#039;))');
});
