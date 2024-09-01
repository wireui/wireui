<?php

namespace Tests\Unit\Traits\Components;

use WireUi\Components\Errors\Multiple as Errors;

beforeEach(function () {
    $this->component = (new Errors)->withName('errors');

    $this->invokeMethod($this->component, 'setConfig');
});

test('it should check that errors is empty', function () {
    $errors = $this->component->errors();

    expect($errors->count())->toBe(0);
});

test('it should check errors', function () {
    $this->withViewErrors(['name' => 'Name is required']);

    $errors = $this->component->errors();

    expect($errors->count())->toBe(1);
});
