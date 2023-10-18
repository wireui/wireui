<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Exceptions\WireUiResolveException;
use WireUi\Traits\Components\HasSetupType;
use WireUi\View\Components\WireUiComponent;

class Type extends WireUiComponent
{
    use HasSetupType;

    public function __construct()
    {
        $this->componentName = 'type';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new Type();
});

// test('it should have config name', function () {
//     $this->invokeMethod($this->component, 'setConfig');

//     expect($this->invokeProperty($this->component, 'config'))->toBe('type-name');
// });

test('it should have all properties empty', function () {
    expect($this->component->type)->toBeNull();

    expect($this->component->typeClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'typeResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupType', [&$data]);
})->throws(WireUiResolveException::class);

test('it should execute base component without value to type', function () {
    $resolve = resolve($class = $this->getPackageClass('Type'));

    $this->invokeMethod($this->component, 'setTypeResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->type)->toBeNull();

    expect($this->component->typeClasses)->toBe($resolve->get());
});

test('it should execute base component with value to type', function () {
    $resolve = resolve($class = $this->getPackageClass('Type'));

    $typeRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'type' => $typeRandom,
    ]);

    $this->invokeMethod($this->component, 'setTypeResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->type)->toBe($typeRandom);

    expect($this->component->typeClasses)->toBe($resolve->get($typeRandom));
});

test('it should execute base component with custom value to type', function () {
    $class = $this->getPackageClass('Type');

    $typeRandom = [
        'z-index'        => 'z-90',
        'spacing'        => 'p-20',
        'soft-scrollbar' => false,
        'hide-scrollbar' => false,
    ];

    $this->component->attributes = new ComponentAttributeBag([
        'type' => $typeRandom,
    ]);

    $this->invokeMethod($this->component, 'setTypeResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->type)->toBe($typeRandom);

    expect($this->component->typeClasses)->toBe($typeRandom);
});
