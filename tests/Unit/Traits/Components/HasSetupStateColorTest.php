<?php

namespace Tests\Unit\Traits\Components;

use WireUi\Components\Button\Base as Button;

beforeEach(function () {
    $this->component = (new Button())->withName('button');

    $this->invokeMethod($this->component, 'setConfig');
});

test('example', function () {
    expect(true)->toBeTrue();
})->todo();
