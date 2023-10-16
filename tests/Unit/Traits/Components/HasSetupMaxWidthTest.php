<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Exceptions\WireUiResolveException;
use WireUi\Traits\Components\HasSetupWidth;
use WireUi\View\Components\BaseComponent;

class MaxWidth extends BaseComponent
{
    use HasSetupWidth;

    public function __construct()
    {
        $this->componentName = 'max-width';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new MaxWidth();
});

// test('it should have config name', function () {
//     $this->invokeMethod($this->component, 'setConfig');

//     expect($this->invokeProperty($this->component, 'config'))->toBe('max-width-name');
// });

test('it should have all properties empty', function () {
    expect($this->component->maxWidth)->toBeNull();

    expect($this->component->maxWidthClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'maxWidthResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupMaxWidth', [&$data]);
})->throws(WireUiResolveException::class);

test('it should execute base component without value to max width', function () {
    $resolve = resolve($class = $this->getPackageClass('MaxWidth'));

    $this->invokeMethod($this->component, 'setMaxWidthResolve', [$class]);

    $this->invokeMethod($this->component, 'runBaseComponent', [$this->component->data()]);

    expect($this->component->maxWidth)->toBeNull();

    expect($this->component->maxWidthClasses)->toBe($resolve->get());
});

test('it should execute base component with value to max width', function () {
    $resolve = resolve($class = $this->getPackageClass('MaxWidth'));

    $maxWidthRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'maxWidth' => $maxWidthRandom,
    ]);

    $this->invokeMethod($this->component, 'setMaxWidthResolve', [$class]);

    $this->invokeMethod($this->component, 'runBaseComponent', [$this->component->data()]);

    expect($this->component->maxWidth)->toBe($maxWidthRandom);

    expect($this->component->maxWidthClasses)->toBe($resolve->get($maxWidthRandom));
});

test('it should execute base component with custom value to max width', function () {
    $class = $this->getPackageClass('MaxWidth');

    $maxWidthRandom = 'max-w-[50%]';

    $this->component->attributes = new ComponentAttributeBag([
        'maxWidth' => $maxWidthRandom,
    ]);

    $this->invokeMethod($this->component, 'setMaxWidthResolve', [$class]);

    $this->invokeMethod($this->component, 'runBaseComponent', [$this->component->data()]);

    expect($this->component->maxWidth)->toBe($maxWidthRandom);

    expect($this->component->maxWidthClasses)->toBe($maxWidthRandom);
});
