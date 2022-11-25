<?php

use Pest\Expectation;

uses(Tests\Browser\BrowserTestCase::class)->in('Browser');
uses(Tests\Unit\TestCase::class)->in('Unit');

expect()->extend('render', function (array $data = []): Expectation {
    /** @var Expectation $this */

    $testView = test()->blade($this->value, $data);

    return expect((string) $testView);
});
