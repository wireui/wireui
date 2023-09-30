<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Exceptions\WireUiResolveException;
use WireUi\Traits\Components\HasSetupShadow;
use WireUi\View\Components\WireUiComponent;

class Shadow extends WireUiComponent
{
    use HasSetupShadow;

    public function __construct()
    {
        $this->componentName = 'shadow';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new Shadow();
});

test('it should have all properties empty', function () {
    expect($this->component->shadow)->toBeNull();

    expect($this->component->shadowless)->toBeFalse();

    expect($this->component->shadowClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'shadowResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupShadow', [&$data]);
})->throws(WireUiResolveException::class);

test('it should execute base component without value to shadow', function () {
    $resolve = resolve($class = $this->getPackageClass('Shadow'));

    $this->invokeMethod($this->component, 'setShadowResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->shadow)->toBeNull();

    expect($this->component->shadowless)->toBeFalse();

    expect($this->component->shadowClasses)->toBe($resolve->get());
});

test('it should execute base component with value to shadow', function () {
    $resolve = resolve($class = $this->getPackageClass('Shadow'));

    $shadowRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'shadowless' => true,
        'shadow'     => $shadowRandom,
    ]);

    $this->invokeMethod($this->component, 'setShadowResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->shadowless)->toBeTrue();

    expect($this->component->shadow)->toBe($shadowRandom);

    expect($this->component->shadowClasses)->toBe($resolve->get($shadowRandom));
});

test('it should execute base component with custom value to shadow', function () {
    $class = $this->getPackageClass('Shadow');

    $shadowRandom = 'shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]';

    $this->component->attributes = new ComponentAttributeBag([
        'shadowless' => false,
        'shadow'     => $shadowRandom,
    ]);

    $this->invokeMethod($this->component, 'setShadowResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->shadowless)->toBeFalse();

    expect($this->component->shadow)->toBe($shadowRandom);

    expect($this->component->shadowClasses)->toBe($shadowRandom);
});
