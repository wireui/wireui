<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\View\ComponentAttributeBag;
use WireUi\Exceptions\WireUiResolveException;
use WireUi\Traits\Components\HasSetupBlur;
use WireUi\View\Components\BaseComponent;

class Blur extends BaseComponent
{
    use HasSetupBlur;

    public function __construct()
    {
        $this->componentName = 'blur';
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
    $this->component = new Blur();
});

// test('it should have config name', function () {
//     $this->invokeMethod($this->component, 'setConfig');

//     expect($this->invokeProperty($this->component, 'config'))->toBe('blur-name');
// });

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

test('it should execute base component without value to blur and blurless', function () {
    $resolve = resolve($class = $this->getPackageClass('Blur'));

    $this->invokeMethod($this->component, 'setBlurResolve', [$class]);

    $this->invokeMethod($this->component, 'executeBaseComponent', [$this->component->data()]);

    expect($this->component->blur)->toBeNull();

    expect($this->component->blurless)->toBeFalse();

    expect($this->component->blurClasses)->toBe($resolve->get());
});

test('it should execute base component with value to blur and blurless', function () {
    $resolve = resolve($class = $this->getPackageClass('Blur'));

    $blurRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'blurless' => true,
        'blur'     => $blurRandom,
    ]);

    $this->invokeMethod($this->component, 'setBlurResolve', [$class]);

    $this->invokeMethod($this->component, 'executeBaseComponent', [$this->component->data()]);

    expect($this->component->blurless)->toBeTrue();

    expect($this->component->blur)->toBe($blurRandom);

    expect($this->component->blurClasses)->toBe($resolve->get($blurRandom));
});
