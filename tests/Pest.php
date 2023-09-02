<?php

use Illuminate\Support\Facades\Blade;
use Pest\Expectation;
use Tests\Browser\BrowserTestCase;
use Tests\Unit\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(TestCase::class)->group('unit')->in('Unit');

uses(BrowserTestCase::class)->group('browser')->in('Browser');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('render', function (array $data = []): Expectation {
    /** @var Expectation $this */
    $this->value = Blade::render($this->value, $data);

    return $this;
});
