<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Traits\Components\HasSetupIcon;
use WireUi\View\Components\WireUiComponent;

class Icon extends WireUiComponent
{
    use HasSetupIcon;

    public function __construct()
    {
        $this->componentName = 'icon';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new Icon();
});

test('it should have all properties empty', function () {
    expect($this->component->icon)->toBeNull();

    expect($this->component->iconless)->toBeFalse();

    expect($this->component->rightIcon)->toBeNull();
});

test('it should execute base component without values', function () {
    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->icon)->toBeNull();

    expect($this->component->iconless)->toBeFalse();

    expect($this->component->rightIcon)->toBeNull();
});

test('it should execute base component with values', function () {
    $icon      = $this->getIcons()->random();
    $rightIcon = $this->getIcons()->random();

    $this->component->attributes = new ComponentAttributeBag([
        'iconless'   => true,
        'icon'       => $icon,
        'right-icon' => $rightIcon,
    ]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    expect($this->component->icon)->toBe($icon);

    expect($this->component->iconless)->toBeTrue();

    expect($this->component->rightIcon)->toBe($rightIcon);
});
