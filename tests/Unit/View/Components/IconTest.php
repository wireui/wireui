<?php

use Illuminate\Support\Facades\Blade;
use Tests\Unit\TestCase;
use WireUi\View\Components\Icon;

it('should render the heroicons', function (string $variant, string $name) {
    /** @var TestCase $this */
    $component = new Icon($name, $variant);

    $html = Blade::renderComponent($component);

    expect(trim($html))
        ->toStartWith('<svg')
        ->toEndWith('</svg>');
})->with([
    ['solid', 'home'],
    ['solid', 'user'],
    ['outline', 'pencil'],
    ['outline', 'x-mark'],
    ['mini', 'check'],
    ['mini', 'arrow-down'],
]);