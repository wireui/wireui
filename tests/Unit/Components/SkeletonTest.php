<?php

use Illuminate\Support\Facades\Blade;

it('should render the default skeleton without specifying name', function () {
    $html = Blade::render('<x-skeleton/>');

    expect($html)->toContain('animate-pulse');
});

it('should render the default skeleton', function () {
    $html = Blade::render('<x-skeleton name="default"/>');

    expect($html)->toContain('animate-pulse');
});

it('should render the image skeleton', function () {
    $html = Blade::render('<x-skeleton name="image"/>');

    expect($html)->toContain('animate-pulse');
});

it('should render the text skeleton', function () {
    $html = Blade::render('<x-skeleton name="text"/>');

    expect($html)->toContain('animate-pulse');
});

it('should render the card skeleton', function () {
    $html = Blade::render('<x-skeleton name="card"/>');

    expect($html)->toContain('animate-pulse');
});

it('should render the testimonial skeleton', function () {
    $html = Blade::render('<x-skeleton name="testimonial"/>');

    expect($html)->toContain('animate-pulse');
});
