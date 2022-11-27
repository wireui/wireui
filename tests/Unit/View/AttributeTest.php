<?php

use Tests\Unit\TestCase;
use WireUi\View\Attribute;

it('should get the attribute directive', function (?string $directive) {
    /** @var TestCase $this */
    $attribute = new Attribute($directive);

    expect($attribute->directive())->toBe($directive);
})->with([
    ['spinner.lazy'],
    ['spinner.lazy.lazy'],
    ['spinner.lazy..bar'],
    ['spinner.lazy.foo.'],
    [''],
    [null, null],
    ['.foo'],
]);

it('should get the attribute name', function (?string $directive, ?string $name) {
    /** @var TestCase $this */
    $attribute = new Attribute($directive);

    expect($attribute->name())->toBe($name);
})->with([
    ['spinner.lazy', 'spinner'],
    ['spinner.lazy.lazy', 'spinner'],
    ['spinner.lazy..bar', 'spinner'],
    ['spinner.lazy.foo.', 'spinner'],
    ['spinner:lazy,foo.', 'spinner'],
    ['', ''],
    [null, ''],
    ['.foo', ''],
]);

it('should get the attribute value', function ($value) {
    /** @var TestCase $this */
    $attribute = new Attribute('value', $value);

    expect($attribute->value())->toBe($value);
})->with([
    [true],
    [false],
    [0],
    [1],
    ['abc'],
    [null],
]);

it('should return true if the attribute has a modifier', function () {
    /** @var TestCase $this */
    $attribute = new Attribute('spinner.lazy', true);

    expect($attribute->hasModifier('lazy'))->toBeTrue();
    expect($attribute->hasModifier('lazily'))->toBeFalse();
});

it('should get filtered the attribute modifiers', function (string $attribute, array $modifiers) {
    /** @var TestCase $this */
    $attribute = new Attribute($attribute, true);

    expect($attribute->modifiers()->toArray())->toBe($modifiers);
})->with([
    ['spinner.lazy', ['lazy']],
    ['spinner.lazy.lazy', ['lazy']],
    ['spinner.lazy..bar', ['lazy', 'bar']],
    ['spinner.lazy.foo.', ['lazy', 'foo']],
]);

it('should return if the attribute exists', function ($attribute) {
    /** @var TestCase $this */
    $attribute = new Attribute($attribute, true);

    expect($attribute->exists())->toBeFalse();
})->with([
    [''],
    [false],
    [null],
]);

it('should get the attribute params', function (string $directive, array $params) {
    /** @var TestCase $this */
    $attribute = new Attribute(
        directive: $directive,
        value: true,
    );

    expect($attribute->params()->toArray())->toBe($params);
})->with([
    'with-2-params' => ['foo:baz,bar', ['baz', 'bar']],
    'with-1-param'  => ['foo:baz', ['baz']],
    'empty-params'  => ['foo', []],
]);
