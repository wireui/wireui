<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Exceptions\WireUiResolveException;
use WireUi\Traits\Components\HasSetupBlur;
use WireUi\View\Components\WireUiComponent;

class Blur extends WireUiComponent
{
    use HasSetupBlur;

    public function __construct()
    {
        $this->componentName = 'blur';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new Blur();
});

test('it should have all properties empty', function () {
    expect($this->component->blur)->toBeNull();

    expect($this->component->blurless)->toBeFalse();

    expect($this->component->blurClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'blurResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupBlur', [&$data]);
})->throws(WireUiResolveException::class);

test('it should execute base component without value to blur', function () {
    $resolve = resolve($class = $this->getPackageClass('Blur'));

    $this->invokeMethod($this->component, 'setBlurResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->blur)->toBeNull();

    expect($this->component->blurless)->toBeFalse();

    expect($this->component->blurClasses)->toBe($resolve->get());
});

test('it should execute base component with value to blur', function () {
    $resolve = resolve($class = $this->getPackageClass('Blur'));

    $blurRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'blurless' => true,
        'blur'     => $blurRandom,
    ]);

    $this->invokeMethod($this->component, 'setBlurResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->blurless)->toBeTrue();

    expect($this->component->blur)->toBe($blurRandom);

    expect($this->component->blurClasses)->toBe($resolve->get($blurRandom));
});

test('it should execute base component with custom value to blur', function () {
    $class = $this->getPackageClass('Blur');

    $blurRandom = 'sm:backdrop-blur-3xl';

    $this->component->attributes = new ComponentAttributeBag([
        'blurless' => false,
        'blur'     => $blurRandom,
    ]);

    $this->invokeMethod($this->component, 'setBlurResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->blurless)->toBeFalse();

    expect($this->component->blur)->toBe($blurRandom);

    expect($this->component->blurClasses)->toBe($blurRandom);
});
