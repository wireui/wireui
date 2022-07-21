<?php

use Illuminate\Support\Facades\Blade;

it('should render the avatar label', function () {
    $html = Blade::render('<x-avatar xs label="ABC" />');

    expect($html)->toContain('ABC');
});

it('should render the avatar src', function () {
    $html = Blade::render('<x-avatar xs src="image.png" />');

    expect($html)->toContain('<img src="image.png"/>');
});

it('should render the default avatar image', function () {
    $html = Blade::render('<x-avatar sm />');

    expect($html)->toContain('<svg class="w-full h-full');
});

it('should render the avatar squared', function () {
    $html = Blade::render('<x-avatar xs squared />');

    expect($html)->toContain('rounded-md');
});

it('can render the avatar custom classes', function () {
    $html = Blade::render('<x-avatar xs avatarClasses="mt-6 ml-6" />');

    expect($html)->toContain('mt-6 ml-6');
});
