<?php

namespace Tests\Unit\Support;

dataset('entangleable', [
    ['null', '@toJs(null)'],
    ['true', '@toJs(true)'],
    ['false', '@toJs(false)'],
    ['1', '@toJs(1)'],
    ['0', '@toJs(0)'],
    ['"foo"', '@toJs("foo")'],
    ['["foo", "bar"]', '@toJs(["foo", "bar"])'],
    ['["foo" => "bar"]', '@toJs(["foo" => "bar"])'],
    ['["foo" => ["bar" => "baz"]]', '@toJs(["foo" => ["bar" => "baz"]])'],
    ['["foo" => ["bar" => ["baz" => "qux"]]]', '@toJs(["foo" => ["bar" => ["baz" => "qux"]]])'],
]);
