<?php

use Illuminate\Support\Facades\Blade;

it('should render the badge slot', function () {
    $html = Blade::render('<x-badge><b>Badge From Slot</b></x-badge>');

    expect($html)->toContain('<b>Badge From Slot</b>');
});

it('should render the large badge', function () {
    $html = Blade::render('<x-badge lg title="Badge From Slot"/>');

    expect($html)->toContain('h-4 w-4');
});

it('should render the badge square', function () {
    $html = Blade::render('<x-badge square title="Badge From Slot" />');

    expect($html)->toContain('rounded');
});

it('should render the badge with pulse', function () {
    $html = Blade::render('<x-badge pulse title="Badge From Slot"/>');

    expect($html)->toContain('<span class="animate-ping');
});

it('should render the badge with info', function () {
    $html = Blade::render('<x-badge info title="Badge From Slot"/>');

    expect($html)->toContain('bg-info-100 text-info-800');
});

it('should render the badge with warning', function () {
    $html = Blade::render('<x-badge warning title="Badge From Slot"/>');

    expect($html)->toContain('bg-warning-100 text-warning-800');
});

it('should render the badge with positive', function () {
    $html = Blade::render('<x-badge positive title="Badge From Slot"/>');

    expect($html)->toContain('bg-positive-100 text-positive-800');
});

it('should render the badge with negative', function () {
    $html = Blade::render('<x-badge negative title="Badge From Slot"/>');

    expect($html)->toContain('bg-negative-100 text-negative-800');
});
