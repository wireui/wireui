<?php

use Illuminate\Support\Facades\Blade;
use Pest\Expectation;

uses(Tests\Browser\BrowserTestCase::class)->in('Browser');
uses(Tests\Unit\TestCase::class)->in('Unit');

expect()->extend('render', function (array $data = []): Expectation {
    /** @var Expectation $this */

    $this->value = Blade::render($this->value, $data);

    return $this;
});
