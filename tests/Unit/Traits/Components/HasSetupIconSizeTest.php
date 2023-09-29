<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Exceptions\WireUiResolveException;
use WireUi\Traits\Components\{HasSetupAlign, HasSetupIconSize};
use WireUi\View\Components\BaseComponent;

class IconSize extends BaseComponent
{
    use HasSetupIconSize;

    public function __construct()
    {
        $this->componentName = 'icon-size';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new IconSize();
});

test('it should have all properties empty', function () {
    expect($this->component->iconSize)->toBeNull();

    expect($this->component->iconSizeClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'iconSizeResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupIconSize', [&$data]);
})->throws(WireUiResolveException::class);

test('it should execute base component without value to icon size', function () {
    $resolve = resolve($class = $this->getPackageClass('IconSize'));

    $this->invokeMethod($this->component, 'setIconSizeResolve', [$class]);

    $this->invokeMethod($this->component, 'runBaseComponent', [$this->component->data()]);

    expect($this->component->iconSize)->toBeNull();

    expect($this->component->iconSizeClasses)->toBe($resolve->get());
});

test('it should execute base component with value to icon size', function () {
    $resolve = resolve($class = $this->getPackageClass('IconSize'));

    $iconSizeRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'iconSize' => $iconSizeRandom,
    ]);

    $this->invokeMethod($this->component, 'setIconSizeResolve', [$class]);

    $this->invokeMethod($this->component, 'runBaseComponent', [$this->component->data()]);

    expect($this->component->iconSize)->toBe($iconSizeRandom);

    expect($this->component->iconSizeClasses)->toBe($resolve->get($iconSizeRandom));
});

test('it should execute base component with custom value to icon size', function () {
    $class = $this->getPackageClass('IconSize');

    $iconSizeRandom = 'w-96 h-96';

    $this->component->attributes = new ComponentAttributeBag([
        'iconSize' => $iconSizeRandom,
    ]);

    $this->invokeMethod($this->component, 'setIconSizeResolve', [$class]);

    $this->invokeMethod($this->component, 'runBaseComponent', [$this->component->data()]);

    expect($this->component->iconSize)->toBe($iconSizeRandom);

    expect($this->component->iconSizeClasses)->toBe($iconSizeRandom);
});
