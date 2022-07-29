<?php

use Illuminate\Support\Facades\Blade;

it('should render the avatar label', function () {
    $html = Blade::render('<x-avatar label="ABC" />');

    expect($html)
        ->toContain('ABC')
        ->not()->toContain('img')
        ->not()->toContain('svg');
});

it('should render the avatar image src', function () {
    $html = Blade::render('<x-avatar src="image.png" />');

    expect($html)
        ->toMatch('/<img[^>]* src="image.png"[^>]*>/')
        ->not()->toContain('span')
        ->not()->toContain('svg');
});

it('should render the default avatar svg', function () {
    $html = Blade::render('<x-avatar />');

    expect($html)
        ->toMatch('/<svg[^>]*>/')
        ->toContain('</svg>')
        ->not()->toContain('span')
        ->not()->toContain('img');
});

it('should render the avatar squared', function () {
    $html = Blade::render('<x-avatar xs squared />');

    expect($html)
        ->toContain('rounded-md')
        ->not()->toContain('rounded-full');
});

it('can render the avatar custom classes', function () {
    $html = Blade::render('<x-avatar class="mt-6 ml-6" />');

    expect($html)->toContain('mt-6 ml-6');
});

it('can render the avatar custom size', function () {
    $html = Blade::render('<x-avatar size="w-20 h-20" />');

    expect($html)->toContain('w-20 h-20');
});

it('can render the default avatar size', function () {
    $html = Blade::render('<x-avatar />');

    expect($html)->toContain('w-10 h-10 text-base');
});

it('should get the correct size classes', function (string $size, string $expected) {
    $html = Blade::render("<x-avatar {$size} />");

    expect($html)->toContain($expected);
})->with([
    ['xs', 'w-6 h-6 text-2xs'],
    ['sm', 'w-8 h-8 text-sm'],
    ['md', 'w-10 h-10 text-base'],
    ['lg', 'w-12 h-12 text-lg'],
    ['xl', 'w-14 h-14 text-xl'],
]);
