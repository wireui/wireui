<?php

namespace Tests\Unit\View;

use WireUi\View\Attribute;

test('it should get the attribute directive', function (?string $directive) {
    $attribute = new Attribute($directive);

    expect($attribute->directive())->toBe($directive);
})->with('attribute::directive');

test('it should get the attribute name', function (string $directive, string $name) {
    $attribute = new Attribute($directive);

    expect($attribute->name())->toBe($name);
})->with('attribute::name');

test('it should get the attribute expression', function ($expression) {
    $attribute = new Attribute('directive', $expression);

    expect($attribute->expression())->toBe($expression);
})->with('attribute::expression');

test('it should get the attribute value', function (string $directive, ?string $value) {
    $attribute = new Attribute($directive);

    expect($attribute->value())->toBe($value);
})->with('attribute::value');

test('it should return true if the attribute has a modifier', function () {
    $attribute = new Attribute('spinner.lazy');

    expect($attribute->hasModifier('lazy'))->toBeTrue();
    expect($attribute->hasModifier('lazily'))->toBeFalse();
});

test('it should get filtered the attribute modifiers', function (string $attribute, array $modifiers) {
    $attribute = new Attribute($attribute, true);

    expect($attribute->modifiers()->toArray())->toBe($modifiers);
})->with('attribute::modifiers');
