<?php

use Illuminate\Support\Facades\Blade;

it('should render the avatar label', function () {
    $html = Blade::render('<x-avatar label="ABC" />');

    expect($html)
        ->toContain('ABC')
        ->not()->toContain('img');
});

it('should render the avatar image src', function () {
    $html = Blade::render('<x-avatar src="image.png" />');

    expect($html)->toContain('<img src="image.png" />');
});

it('should render the default avatar svg', function () {
    $html = Blade::render('<x-avatar />');

    expect($html)
        ->toContain('<svg class="w-full h-full')
        ->not()->toContain('img');
});

it('should render the avatar squared', function () {
    $html = Blade::render('<x-avatar xs squared />');

    expect($html)->toContain('rounded-md');
});

it('can render the avatar custom classes', function () {
    $html = Blade::render('<x-avatar class="mt-6 ml-6" />');

    expect($html)->toContain('mt-6 ml-6');
});

it('should get the correct size classes', function (string $size, string $expected) {
    $html = Blade::render("<x-avatar {$size} />");

    expect($html)->toContain($expected);
})->with([
    ['xs', 'w-6 h-6'],
    ['sm', 'w-8 h-8'],
    ['md', 'w-10 h-10'],
    ['lg', 'w-12 h-12'],
    ['xl', 'w-14 h-14'],
    ['full', 'w-full h-full'],
]);
