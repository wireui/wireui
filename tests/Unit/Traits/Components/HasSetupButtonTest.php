<?php

namespace Tests\Unit\Traits\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Traits\Components\HasSetupButton;
use WireUi\View\Components\WireUiComponent;

class Button extends WireUiComponent
{
    use HasSetupButton;

    public function __construct(
        public bool $loading = false,
    ) {
        $this->componentName = 'button';
    }

    protected function blade(): View
    {
        return view('test');
    }
}

beforeEach(function () {
    $this->component = new Button();
});

test('it should have all properties empty', function () {
    expect($this->component->tag)->toBeNull();
});

test('it should execute base component type button', function () {
    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    $newData = $this->component->data();

    expect($this->component->tag)->toBe('button');

    expect($this->component->loading)->toBeFalse();

    expect($newData['attributes']->get('type'))->toBe('button');
});

test('it should execute base component type link', function () {
    $this->component->attributes = new ComponentAttributeBag([
        'href' => fake()->url(),
    ]);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    $newData = $this->component->data();

    expect($this->component->tag)->toBe('a');

    expect($this->component->loading)->toBeFalse();

    expect($newData['attributes']->has('type'))->toBeFalse();
});

test('it should execute base component with loading', function () {
    $this->component = new Button(loading: true);

    $this->invokeMethod($this->component, 'runWireUiComponent', [$this->component->data()]);

    $newData = $this->component->data();

    expect($this->component->loading)->toBeTrue();

    expect($newData['attributes']->get('wire:loading.attr'))->toBe('disabled');

    expect($newData['attributes']->get('wire:loading.class'))->toBe('!cursor-wait');
});
