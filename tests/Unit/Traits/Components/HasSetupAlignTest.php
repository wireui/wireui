<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Traits\Components\HasSetupAlign;
use WireUi\View\Components\WireUiComponent;

class Align extends WireUiComponent
{
    use HasSetupAlign;

    public function __construct()
    {
        $this->componentName = 'align';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new Align();
});

test('it should have all properties empty', function () {
    expect($this->component->align)->toBeNull();

    expect($this->component->alignClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'alignResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupAlign', [&$data]);
});

test('it should execute base component without value to align', function () {
    $resolve = resolve($class = $this->getPackageClass('Align'));

    $this->invokeMethod($this->component, 'setAlignResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->align)->toBeNull();

    expect($this->component->alignClasses)->toBe($resolve->get());
});

test('it should execute base component with value to align', function () {
    $resolve = resolve($class = $this->getPackageClass('Align'));

    $alignRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'align' => $alignRandom,
    ]);

    $this->invokeMethod($this->component, 'setAlignResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->align)->toBe($alignRandom);

    expect($this->component->alignClasses)->toBe($resolve->get($alignRandom));
});

test('it should execute base component with custom value to align', function () {
    $class = $this->getPackageClass('Align');

    $alignRandom = 'sm:items-baseline';

    $this->component->attributes = new ComponentAttributeBag([
        'align' => $alignRandom,
    ]);

    $this->invokeMethod($this->component, 'setAlignResolve', [$class]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->align)->toBe($alignRandom);

    expect($this->component->alignClasses)->toBe($alignRandom);
});
