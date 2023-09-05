<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\View\ComponentAttributeBag;
use WireUi\Exceptions\WireUiResolveException;
use WireUi\Traits\Components\HasSetupPosition;
use WireUi\View\Components\BaseComponent;

class Position extends BaseComponent
{
    use HasSetupPosition;

    public function __construct()
    {
        $this->componentName = 'position';
    }

    protected function getView(): string
    {
        return <<<EOT
        <div>
            <h1>MockComponent</h1>
        </div>
        EOT;
    }
}

beforeEach(function () {
    $this->component = new Position();
});

// test('it should have config name', function () {
//     $this->invokeMethod($this->component, 'setConfig');

//     expect($this->invokeProperty($this->component, 'config'))->toBe('position-name');
// });

test('it should have all properties empty', function () {
    expect($this->component->position)->toBeNull();

    expect($this->component->positionClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'positionResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupPosition', [&$data]);
})->throws(WireUiResolveException::class);

test('it should execute base component without value to position', function () {
    $resolve = resolve($class = $this->getPackageClass('Position'));

    $this->invokeMethod($this->component, 'setPositionResolve', [$class]);

    $this->invokeMethod($this->component, 'executeBaseComponent', [$this->component->data()]);

    expect($this->component->position)->toBeNull();

    expect($this->component->positionClasses)->toBe($resolve->get());
});

test('it should execute base component with value to position', function () {
    $resolve = resolve($class = $this->getPackageClass('Position'));

    $positionRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'position' => $positionRandom,
    ]);

    $this->invokeMethod($this->component, 'setPositionResolve', [$class]);

    $this->invokeMethod($this->component, 'executeBaseComponent', [$this->component->data()]);

    expect($this->component->position)->toBe($positionRandom);

    expect($this->component->positionClasses)->toBe($resolve->get($positionRandom));
});

test('it should execute base component with custom value to position', function () {
    $class = $this->getPackageClass('Position');

    $positionRandom = 'sm:items-end sm:justify-start';

    $this->component->attributes = new ComponentAttributeBag([
        'position' => $positionRandom,
    ]);

    $this->invokeMethod($this->component, 'setPositionResolve', [$class]);

    $this->invokeMethod($this->component, 'executeBaseComponent', [$this->component->data()]);

    expect($this->component->position)->toBe($positionRandom);

    expect($this->component->positionClasses)->toBe($positionRandom);
});
