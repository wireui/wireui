<?php

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

uses(BrowserTestCase::class)->group('button')->in('Browser');

uses(TestCase::class)->group('button')->in('Unit');