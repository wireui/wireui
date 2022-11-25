<?php

use Illuminate\Support\Facades\Blade;

it('should render the button slot', function () {
    $html = Blade::render('<x-button><b>Label From Slot</b></x-button>');

    expect($html)->toContain('<b>Label From Slot</b>');
});

it('should render the spinner', function () {
    $html = Blade::render('<x-button primary label="primary" spinner />');

    expect($html)->toContain('<svg class="animate-spin');
});
