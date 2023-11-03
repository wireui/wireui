<?php

namespace Tests\Unit\View;

dataset('attribute::directive', [
    ['spinner.lazy'],
    ['spinner.lazy.lazy'],
    ['spinner.lazy..bar'],
    ['spinner.lazy.foo.'],
    [''],
    ['.foo'],
]);

dataset('attribute::name', [
    ['spinner.lazy', 'spinner'],
    ['spinner.lazy.lazy', 'spinner'],
    ['spinner.lazy..bar', 'spinner'],
    ['spinner.lazy.foo.', 'spinner'],
    ['spinner:lazy,foo.', 'spinner'],
    ['', ''],
    ['.foo', ''],
]);

dataset('attribute::expression', [
    ['true'],
    ['false'],
    ['0'],
    ['1'],
    ['abc'],
    [null],
]);

dataset('attribute::value', [
    ['spinner:lazy', 'lazy'],
    ['spinner:lazy.foo', 'lazy'],
    ['spinner.lazy..bar', null],
    ['spinner:bar.lazy.foo.', 'bar'],
    ['', null],
    ['.foo', null],
]);

dataset('attribute::modifiers', [
    ['spinner.lazy', ['lazy']],
    ['spinner.lazy.lazy', ['lazy']],
    ['spinner.lazy..bar', ['lazy', 'bar']],
    ['spinner.lazy.foo.', ['lazy', 'foo']],
    ['spinner:fast.lazy.foo', ['lazy', 'foo']],
]);

dataset('wireui::scripts', [
    ['@wireUiScripts'],
    ['@wireUiScripts()'],
    ['@wireUiScripts([])'],
    ["@wireUiScripts(['foo' => 'bar'])"],
    ['<wireui:scripts />'],
]);
