<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Traits\Components\HasSetupPadding;
use WireUi\View\Components\WireUiComponent;

class Padding extends WireUiComponent
{
    use HasSetupPadding;

    public function __construct()
    {
        $this->componentName = 'padding';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new Padding();
});

test('it should have all properties empty', function () {
    expect($this->component->padding)->toBeNull();

    expect($this->component->paddingClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'paddingResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupPadding', [&$data]);
});

test('it should execute base component without value to padding', function () {
    $resolve = resolve($class = $this->getPackageClass('Padding'));

    $this->invokeMethod($this->component, 'setPaddingResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->padding)->toBeNull();

    expect($this->component->paddingClasses)->toBe($resolve->get());
});

test('it should execute base component with value to padding', function () {
    $resolve = resolve($class = $this->getPackageClass('Padding'));

    $paddingRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'padding' => $paddingRandom,
    ]);

    $this->invokeMethod($this->component, 'setPaddingResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->padding)->toBe($paddingRandom);

    expect($this->component->paddingClasses)->toBe($resolve->get($paddingRandom));
});

test('it should execute base component with custom value to padding', function () {
    $class = $this->getPackageClass('Padding');

    $paddingRandom = 'p-20';

    $this->component->attributes = new ComponentAttributeBag([
        'padding' => $paddingRandom,
    ]);

    $this->invokeMethod($this->component, 'setPaddingResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->padding)->toBe($paddingRandom);

    expect($this->component->paddingClasses)->toBe($paddingRandom);
});
