<?php

use Illuminate\Support\Collection;
use WireUi\View\Components\ColorPicker;

it('should parse the colors', function (array|Collection $colors) {
    $component = new ColorPicker(colors: $colors);

    $parsedColors = $component->getColors();

    expect($parsedColors)->toHaveLength(2);

    foreach ($parsedColors as $color) {
        expect($color)->toHaveKeys(['name', 'value']);
    }

    expect($parsedColors[0]['value'])->toBe('#123');
    expect($parsedColors[1]['value'])->toBe('#456');
})->with([
    'array'      => [['#123', '#456']],
    'collection' => [
        collect([
            '#123',
            '#456',
        ]),
    ],
    'array.full' => [
        [
            ['name' => 'Color 1', 'value' => '#123'],
            ['name' => 'Color 2', 'value' => '#456'],
        ],
    ],
    'collection.full' => [
        collect([
            ['name' => 'Color 1', 'value' => '#123'],
            ['name' => 'Color 2', 'value' => '#456'],
        ]),
    ],
]);
