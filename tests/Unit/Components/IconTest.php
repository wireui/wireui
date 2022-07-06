<?php

use WireUi\View\Components\Icon;

it('should get the correct icon style', function ($expected, $name, $style, $solid, $outline) {
    $component = new Icon($name, $style, $solid, $outline);

    $parsedStyle = $this->invokeMethod($component, 'getStyle');

    expect($parsedStyle)->toBe($expected);
})->with([
    ['solid', 'home', 'solid', false, false],
    ['solid', 'home', null, true, false],
    ['outline', 'home', null, false, true],
    ['outline', 'home', null, false, false],
]);
