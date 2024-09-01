<?php

namespace Tests\Unit\Support;

use WireUi\Exceptions\WireUiAttributeException;
use WireUi\Support\ComponentPack;
use WireUi\WireUiConfig as Config;

class ExamplePack extends ComponentPack
{
    protected function default(): string
    {
        return 'key-1';
    }

    public function all(): array
    {
        return [
            'key-1' => 'value-1',
            'key-2' => 'value-2',
            'key-3' => 'value-3',
        ];
    }
}

beforeEach(function () {
    $this->pack = new ExamplePack;
});

test('it should get the default value', function () {
    $value = $this->invokeMethod($this->pack, 'getDefault');

    expect($value)->toBe('value-1');
});

test('it should get the value by key', function () {
    $value = $this->pack->get(null);

    expect($value)->toBe('value-1');

    $value = $this->pack->get(Config::GLOBAL);

    expect($value)->toBe('value-1');

    $value = $this->pack->get('key-2');

    expect($value)->toBe('value-2');
});

test('it should merge the values', function () {
    $value = $this->pack->mergeIf(false, 'key-2', 'key-1');

    expect($value)->toBe('value-1');

    $value = $this->pack->mergeIf(true, 'key-2', 'key-1');

    expect($value)->toBe(['value-2', 'value-1']);
});

test('it should get the keys', function () {
    $keys = $this->pack->keys();

    expect($keys)->toBe(['key-1', 'key-2', 'key-3']);
});

test('it should throw an exception if the attribute is not valid', function () {
    $this->invokeMethod($this->pack, 'checkAttribute', ['key-4']);
})->throws(WireUiAttributeException::class);
