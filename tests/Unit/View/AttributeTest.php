<?php

use WireUi\View\Attribute;

it('should get the attribute directive', function (?string $directive) {
    $attribute = new Attribute($directive);

    expect($attribute->directive())->toBe($directive);
})->with([
    ['spinner.lazy'],
    ['spinner.lazy.lazy'],
    ['spinner.lazy..bar'],
    ['spinner.lazy.foo.'],
    [''],
    ['.foo'],
]);

it('should get the attribute name', function (string $directive, string $name) {
    $attribute = new Attribute($directive);

    expect($attribute->name())->toBe($name);
})->with([
    ['spinner.lazy', 'spinner'],
    ['spinner.lazy.lazy', 'spinner'],
    ['spinner.lazy..bar', 'spinner'],
    ['spinner.lazy.foo.', 'spinner'],
    ['spinner:lazy,foo.', 'spinner'],
    ['', ''],
    ['.foo', ''],
]);

it('should get the attribute expression', function ($expression) {
    $attribute = new Attribute('directive', $expression);

    expect($attribute->expression())->toBe($expression);
})->with([
    ['true'],
    ['false'],
    ['0'],
    ['1'],
    ['abc'],
    [null],
]);

it('should get the attribute value', function (string $directive, ?string $value) {
    $attribute = new Attribute($directive);

    expect($attribute->value())->toBe($value);
})->with([
    ['spinner:lazy', 'lazy'],
    ['spinner:lazy.foo', 'lazy'],
    ['spinner.lazy..bar', null],
    ['spinner:bar.lazy.foo.', 'bar'],
    ['', null],
    ['.foo', null],
]);

it('should return true if the attribute has a modifier', function () {
    $attribute = new Attribute('spinner.lazy');

    expect($attribute->hasModifier('lazy'))->toBeTrue();
    expect($attribute->hasModifier('lazily'))->toBeFalse();
});

it('should get filtered the attribute modifiers', function (string $attribute, array $modifiers) {
    $attribute = new Attribute($attribute, true);

    expect($attribute->modifiers()->toArray())->toBe($modifiers);
})->with([
    ['spinner.lazy', ['lazy']],
    ['spinner.lazy.lazy', ['lazy']],
    ['spinner.lazy..bar', ['lazy', 'bar']],
    ['spinner.lazy.foo.', ['lazy', 'foo']],
    ['spinner:fast.lazy.foo', ['lazy', 'foo']],
]);

