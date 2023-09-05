<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\View\ComponentAttributeBag;
use WireUi\Exceptions\WireUiResolveException;
use WireUi\Traits\Components\HasSetupUnderline;
use WireUi\View\Components\BaseComponent;

class Underline extends BaseComponent
{
    use HasSetupUnderline;

    public function __construct()
    {
        $this->componentName = 'underline';
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
    $this->component = new Underline();
});

// test('it should have config name', function () {
//     $this->invokeMethod($this->component, 'setConfig');

//     expect($this->invokeProperty($this->component, 'config'))->toBe('underline-name');
// });

test('it should have all properties empty', function () {
    expect($this->component->underline)->toBeNull();

    expect($this->component->underlineClasses)->toBeNull();

    expect($this->invokeProperty($this->component, 'underlineResolve'))->toBeNull();
});

test('it should dispatch exception because the resolve is empty', function () {
    $data = $this->component->data();

    $this->invokeMethod($this->component, 'setupUnderline', [&$data]);
})->throws(WireUiResolveException::class);

test('it should execute base component without value to underline', function () {
    $resolve = resolve($class = $this->getPackageClass('Underline'));

    $this->invokeMethod($this->component, 'setUnderlineResolve', [$class]);

    $this->invokeMethod($this->component, 'executeBaseComponent', [$this->component->data()]);

    expect($this->component->underline)->toBeNull();

    expect($this->component->underlineClasses)->toBe($resolve->get());
});

test('it should execute base component with value to underline', function () {
    $resolve = resolve($class = $this->getPackageClass('Underline'));

    $underlineRandom = collect($resolve->keys())->random();

    $this->component->attributes = new ComponentAttributeBag([
        'underline' => $underlineRandom,
    ]);

    $this->invokeMethod($this->component, 'setUnderlineResolve', [$class]);

    $this->invokeMethod($this->component, 'executeBaseComponent', [$this->component->data()]);

    expect($this->component->underline)->toBe($underlineRandom);

    expect($this->component->underlineClasses)->toBe($resolve->get($underlineRandom));
});

test('it should execute base component with custom value to underline', function () {
    $class = $this->getPackageClass('Underline');

    $underlineRandom = 'overline';

    $this->component->attributes = new ComponentAttributeBag([
        'underline' => $underlineRandom,
    ]);

    $this->invokeMethod($this->component, 'setUnderlineResolve', [$class]);

    $this->invokeMethod($this->component, 'executeBaseComponent', [$this->component->data()]);

    expect($this->component->underline)->toBe($underlineRandom);

    expect($this->component->underlineClasses)->toBe($underlineRandom);
});
