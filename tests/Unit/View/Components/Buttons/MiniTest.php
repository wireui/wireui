<?php

use Illuminate\Support\Facades\Blade;
use WireUi\Support\Buttons\Colors\{ColorPack, Solid};
use WireUi\Support\Buttons\Sizes\Mini;

it('should render a button with as a link')
    ->expect('<x-buttons.mini href="#">Go</x-buttons.mini>')
    ->render()
    ->toContain('<a', 'href="#"', 'Go');

it('should render the button default slot')
    ->expect('<x-buttons.mini><b>+9</b></x-buttons.mini>')
    ->render()
    ->toContain('<b>+9</b>');

it('should render a spinner')
    ->expect('<x-buttons.mini primary label="GG" spinner />')
    ->render()
    ->toContain(
        '<svg class="animate-spin',
        'wire:loading.delay="true"'
    );

it('should render a spinner with a custom delay')
    ->expect('<x-buttons.mini primary label="GG" spinner.long />')
    ->render()
    ->toContain('wire:loading.delay.long="true"');

it('should render a spinner with a target')
    ->expect('<x-buttons.mini primary label="Go" spinner="save" />')
    ->render()
    ->toContain('wire:target="save"');

it('should not render a spinner')
    ->expect('<x-buttons.mini primary label="PO" />')
    ->render()
    ->not()
    ->toContain('<svg class="animate-spin');

it('should have a disabling state on livewire loading')
    ->expect('<x-buttons.mini>A+</x-buttons.mini>')
    ->render()
    ->toContain(
        'wire:loading.attr="disabled"',
        'wire:loading.class="!cursor-wait"'
    );

it('should without disabling on livewire loading')
    ->expect('<x-buttons.mini :disabled-on-wire-loading="false">CK</x-buttons.mini>')
    ->render()
    ->not()->toContain(
        'wire:loading.attr="disabled"',
        'wire:loading.class="!cursor-wait"'
    );

it('should have by default a button type')
    ->expect('<x-buttons.mini>XD</x-buttons.mini>')
    ->render()
    ->toContain('type="button"');

it('should change the button type')
    ->expect('<x-buttons.mini type="submit">:)</x-buttons.mini>')
    ->render()
    ->toContain('type="submit"');

it('should render all color classes from attributes', function (string $class, string $variant, string $color) {
    /** @var ColorPack $colorPack */
    $colorPack = new $class();

    expect("<x-buttons.mini {$variant} {$color} />")
        ->render()
        ->toContain($colorPack->get($color)->toString())
        ->not()->toContain($colorPack->default()->toString());
})->with('buttons::variant-color');

it('should render all color classes from props', function (string $class, string $variant, string $color) {
    /** @var ColorPack $colorPack */
    $colorPack = new $class();

    expect("<x-buttons.mini variant=\"{$variant}\" color=\"{$color}\" />")
        ->render()
        ->toContain($colorPack->get($color)->toString())
        ->not()
        ->toContain($colorPack->default()->toString());
})->with('buttons::variant-color');

it('should render all sizes classes from attributes', function (string $size) {
    expect("<x-buttons.mini {$size} />")
        ->render()
        ->toContain((new Mini\Base())->get($size));
})->with('buttons::sizes');

it('should render all sizes classes from props', function (string $size) {
    expect("<x-buttons.mini size=\"{$size}\" />")
        ->render()
        ->toContain((new Mini\Base())->get($size));
})->with('buttons::sizes');

it('should render a squared button')
    ->expect('<x-buttons.mini squared />')
    ->render()
    ->not()
    ->toContain('/(rounded)*/');

it('should render a pill button')
    ->expect('<x-buttons.mini rounded />')
    ->render()
    ->toContain('rounded-full');

it('should pass the attributes bag to the button')
    ->expect('<x-buttons.mini foo="bar" disabled aria-label="test" />')
    ->render()
    ->toContain(
        'foo="bar"',
        'disabled="disabled"',
        'aria-label="test"'
    );

it('should render a button with a label')
    ->expect('<x-buttons.mini label="AB" />')
    ->render()
    ->toContain('AB');

it('should render a button with an icon with default size', function () {
    expect('<x-buttons.mini icon="home" />')
        ->render()
        ->toContain(
            Blade::render('<x-heroicons::outline.home class="w-4 h-4 shrink-0" />')
        );
});

it('should render with a icon with different size', function (string $size) {
    $css = (new Mini\Icon())->get($size);

    expect("<x-buttons.mini {$size} icon=\"home\" />")
        ->render()
        ->toContain(
            Blade::render("<x-heroicons::outline.home class=\"{$css} shrink-0\" />")
        );
})->with('buttons::sizes');

it('should render a icon with custom size', function () {
    expect('<x-buttons.mini class="my-padding" icon="home" icon-size="my-custom icon-size" />')
        ->render()
        ->toContain(
            'my-padding',
            Blade::render('<x-heroicons::outline.home class="my-custom icon-size shrink-0" />')
        );
});

it('should render a button with two differents colors when interacting', function () {
    expect('<x-buttons.mini primary hover:yellow focus:green />')
        ->render()
        ->toContain(
            (new Solid())->get('primary')->base,
            (new Solid())->get('yellow')->hover,
            (new Solid())->get('green')->focus
        );
});

it('should render a button with one different color when interacting', function () {
    expect('<x-buttons.mini primary interaction:green />')
        ->render()
        ->toContain(
            (new Solid())->get('primary')->base,
            (new Solid())->get('green')->hover,
            (new Solid())->get('green')->focus
        );
});
