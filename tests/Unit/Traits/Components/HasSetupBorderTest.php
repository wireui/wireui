<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Exceptions\WireUiResolveException;
use WireUi\Traits\Components\HasSetupBorder;
use WireUi\View\Components\BaseComponent;

class Border extends BaseComponent
{
    use HasSetupBorder;

    public function __construct()
    {
        $this->componentName = 'border';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new Border();
});

// test('it should have config name', function () {
//     $this->invokeMethod($this->component, 'setConfig');

//     expect($this->invokeProperty($this->component, 'config'))->toBe('border-name');
// });

test('it should have all properties empty', function () {
    expect($this->component->border)->toBeNull();

    expect($this->component->borderless)->toBeFalse();

    expect($this->component->borderClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'borderResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupBorder', [&$data]);
})->throws(WireUiResolveException::class);

test('it should execute base component without value to border', function () {
    $resolve = resolve($class = $this->getPackageClass('Border'));

    $this->invokeMethod($this->component, 'setBorderResolve', [$class]);

    $this->invokeMethod($this->component, 'runBaseComponent', [$this->component->data()]);

    expect($this->component->border)->toBeNull();

    expect($this->component->borderless)->toBeFalse();

    expect($this->component->borderClasses)->toBe($resolve->get());
});

test('it should execute base component with value to border', function () {
    $resolve = resolve($class = $this->getPackageClass('Border'));

    $borderRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'borderless' => true,
        'border'     => $borderRandom,
    ]);

    $this->invokeMethod($this->component, 'setBorderResolve', [$class]);

    $this->invokeMethod($this->component, 'runBaseComponent', [$this->component->data()]);

    expect($this->component->borderless)->toBeTrue();

    expect($this->component->border)->toBe($borderRandom);

    expect($this->component->borderClasses)->toBe($resolve->get($borderRandom));
});

test('it should execute base component with custom value to border', function () {
    $class = $this->getPackageClass('Border');

    $borderRandom = 'border-8 border-dashed';

    $this->component->attributes = new ComponentAttributeBag([
        'borderless' => false,
        'border'     => $borderRandom,
    ]);

    $this->invokeMethod($this->component, 'setBorderResolve', [$class]);

    $this->invokeMethod($this->component, 'runBaseComponent', [$this->component->data()]);

    expect($this->component->borderless)->toBeFalse();

    expect($this->component->border)->toBe($borderRandom);

    expect($this->component->borderClasses)->toBe($borderRandom);
});
