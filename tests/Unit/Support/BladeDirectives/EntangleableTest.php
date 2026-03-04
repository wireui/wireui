<?php

namespace Tests\Unit\Support\BladeDirectives;

use Illuminate\Support\Facades\View;
use Illuminate\View\ComponentAttributeBag;
use Tests\Unit\TestComponent;

test('it should render the default value when livewire instance doest exists', function (
    string $fallback,
    string $expected,
) {
    $blade = "@entangleable('user.name', {$fallback})";

    $this->blade($blade)->assertSee($expected, escape: false);
})->with([
    ['null', 'null'],
    ['true', 'true'],
    ['false', 'false'],
    ['1', '1'],
    ['0', '0'],
    ['"foo"', '\'foo\''],
    ['["foo", "bar"]', 'JSON.parse(atob(\'WyJmb28iLCJiYXIiXQ==\'))'],
    ['["foo" => "bar"]', 'JSON.parse(atob(\'eyJmb28iOiJiYXIifQ==\'))'],
    ['["foo" => ["bar" => "baz"]]', 'JSON.parse(atob(\'eyJmb28iOnsiYmFyIjoiYmF6In19\'))'],
    ['["foo" => ["bar" => ["baz" => "qux"]]]', 'JSON.parse(atob(\'eyJmb28iOnsiYmFyIjp7ImJheiI6InF1eCJ9fX0=\'))'],
]);

test('it should render the entangle directive from the string attribute', function () {
    $blade = <<<'BLADE'
        <div x-data="{
            model: @entangleable('name'),
        }">
            ...
        </div>
    BLADE;

    View::share('__livewire', new TestComponent());

    $this->blade($blade)->assertSee("window.Livewire.find('fake-id').entangle('name')", escape: false);
});

test('it should render the entangle directive from the wire model attribute', function () {
    $blade = <<<'BLADE'
        <div x-data="{
            model: @entangleable($attributes->wire('model')),
        }">
            ...
        </div>
    BLADE;

    View::share('__livewire', new TestComponent());
    View::share('attributes', new ComponentAttributeBag(['wire:model' => 'name']));

    $this->blade($blade)->assertSee("window.Livewire.find('fake-id').entangle('name')", escape: false);
});

test('it should render the entangle directive from the wire model live attribute', function () {
    $blade = <<<'BLADE'
        <div x-data="{
            model: @entangleable($attributes->wire('model')),
        }">
            ...
        </div>
    BLADE;

    View::share('__livewire', new TestComponent());
    View::share('attributes', new ComponentAttributeBag(['wire:model.live' => 'name']));

    $this->blade($blade)->assertSee("window.Livewire.find('fake-id').entangle('name').live", escape: false);
});

test('it should render the entangle directive from the wire model blur attribute', function () {
    $blade = <<<'BLADE'
        <div x-data="{
            model: @entangleable($attributes->wire('model')),
        }">
            ...
        </div>
    BLADE;

    View::share('__livewire', new TestComponent());
    View::share('attributes', new ComponentAttributeBag(['wire:model.blur' => 'name']));

    $this->blade($blade)->assertSee("window.Livewire.find('fake-id').entangle('name').live", escape: false);
});
