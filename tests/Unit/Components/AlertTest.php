<?php

use Illuminate\Support\Facades\Blade;

it('should render the alert slot', function () {
    $html = Blade::render('<x-alert><b>Text From Slot</b></x-alert>');

    expect($html)->toContain('<b>Text From Slot</b>');
});
