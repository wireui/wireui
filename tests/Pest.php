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

uses(TestCase::class)->group('unit-components')->in('../src/Components/*/tests/Unit');

uses(BrowserTestCase::class)->group('browser-components')->in('../src/Components/*/tests/Browser');

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

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function render(string $view, array $data = []): string
{
    return Blade::render($view, $data);
}
