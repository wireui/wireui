<?php

use Illuminate\Support\Facades\Blade;
use WireUi\Support\Buttons\Colors\{ColorPack, Flat, Outline, Solid};
use WireUi\Support\Buttons\Sizes\Mini;

it('should render a button with as a link')
    ->expect('<x-mini-button href="#">Go</x-mini-button>')
    ->render()
    ->toContain('<a', 'href="#"', 'Go');

it('should render the button default slot')
    ->expect('<x-mini-button><b>+9</b></x-mini-button>')
    ->render()
    ->toContain('<b>+9</b>');

it('should render a spinner')
    ->expect('<x-mini-button primary label="GG" spinner />')
    ->render()
    ->toContain(
        '<svg class="animate-spin',
        'wire:loading.delay="true"',
    );

it('should render a spinner with a custom delay')
    ->expect('<x-mini-button primary label="GG" spinner.long />')
    ->render()
    ->toContain('wire:loading.delay.long="true"');

it('should render a spinner with a target')
    ->expect('<x-mini-button primary label="Go" spinner="save" />')
    ->render()
    ->toContain('wire:target="save"');

it('should not render a spinner')
    ->expect('<x-mini-button primary label="PO" />')
    ->render()
    ->not()
    ->toContain('<svg class="animate-spin');

it('should have a disabling state on livewire loading')
    ->expect('<x-mini-button>A+</x-mini-button>')
    ->render()
    ->toContain(
        'wire:loading.attr="disabled"',
        'wire:loading.class="!cursor-wait"',
    );

it('should without disabling on livewire loading')
    ->expect('<x-mini-button :disabled-on-wire-loading="false">CK</x-mini-button>')
    ->render()
    ->not()->toContain(
        'wire:loading.attr="disabled"',
        'wire:loading.class="!cursor-wait"',
    );

it('should have by default a button type')
    ->expect('<x-mini-button>XD</x-mini-button>')
    ->render()
    ->toContain('type="button"');

it('should change the button type')
    ->expect('<x-mini-button type="submit">:)</x-mini-button>')
    ->render()
    ->toContain('type="submit"');

it('should render all color classes from attributes', function (string $class, string $variant, string $color) {
    /** @var ColorPack $colorPack */
    $colorPack = new $class();

    expect("<x-mini-button {$variant} {$color} />")
        ->render()
        ->toContain($colorPack->get($color)->toString())
        ->not()->toContain($colorPack->default()->toString());
})->with('buttons::variant-color');

it('should render all color classes from props', function (string $class, string $variant, string $color) {
    /** @var ColorPack $colorPack */
    $colorPack = new $class();

    expect("<x-mini-button variant=\"{$variant}\" color=\"{$color}\" />")
        ->render()
        ->toContain($colorPack->get($color)->toString())
        ->not()
        ->toContain($colorPack->default()->toString());
})->with('buttons::variant-color');

it('should render all sizes classes from attributes', function (string $size) {
    expect("<x-mini-button {$size} />")
        ->render()
        ->toContain((new Mini\Base())->get($size));
})->with('buttons::sizes');

it('should render all sizes classes from props', function (string $size) {
    expect("<x-mini-button size=\"{$size}\" />")
        ->render()
        ->toContain((new Mini\Base())->get($size));
})->with('buttons::sizes');

it('should render a squared button')
    ->expect('<x-mini-button squared />')
    ->render()
    ->not()
    ->toContain('/(rounded)*/');

it('should render a pill button')
    ->expect('<x-mini-button rounded />')
    ->render()
    ->toContain('rounded-full');

it('should pass the attributes bag to the button')
    ->expect('<x-mini-button foo="bar" disabled aria-label="test" />')
    ->render()
    ->toContain(
        'foo="bar"',
        'disabled="disabled"',
        'aria-label="test"',
    );

it('should render a button with a label')
    ->expect('<x-mini-button label="AB" />')
    ->render()
    ->toContain('AB');

it('should render a button with an icon with default size', function () {
    expect('<x-mini-button icon="home" />')
        ->render()
        ->toContain(
            Blade::render('<x-heroicons::outline.home class="w-4 h-4 shrink-0" />'),
        );
});

it('should render with a icon with different size', function (string $size) {
    $css = (new Mini\Icon())->get($size);

    expect("<x-mini-button {$size} icon=\"home\" />")
        ->render()
        ->toContain(
            Blade::render("<x-heroicons::outline.home class=\"{$css} shrink-0\" />"),
        );
})->with('buttons::sizes');

it('should render a icon with custom size', function () {
    expect('<x-mini-button class="my-padding" icon="home" icon-size="my-custom icon-size" />')
        ->render()
        ->toContain(
            'my-padding',
            Blade::render('<x-heroicons::outline.home class="my-custom icon-size shrink-0" />'),
        );
});

it('should render a button with two different colors on "hover" or "focus"', function () {
    expect('<x-mini-button primary hover="yellow" focus="green" />')
        ->render()
        ->toContain(
            (new Solid())->get('primary')->base,
            (new Solid())->get('yellow')->hover,
            ...(new Solid())->get('green')->focus,
        )
        ->not()->toContain(
            (new Solid())->get('primary')->hover,
            (new Solid())->get('primary')->focus,
        );
});

it('should render a button with one different color on "interaction"', function () {
    expect('<x-mini-button primary interaction="green" />')
        ->render()
        ->toContain(
            (new Solid())->get('primary')->base,
            (new Solid())->get('green')->hover,
            ...(new Solid())->get('green')->focus,
        )
        ->not()->toContain(
            (new Solid())->get('primary')->hover,
            ...(new Solid())->get('primary')->focus,
        );
});

it('should render a button with two different colors and variants when interacting', function (string $code) {
    expect($code)
        ->render()
        ->toContain(
            (new Solid())->get('primary')->base,
            ...(new Flat())->get('yellow')->hover,
            ...(new Outline())->get('green')->focus,
        )
        ->not()->toContain(
            (new Solid())->get('primary')->hover,
            ...(new Solid())->get('primary')->focus,
        );
})->with([
    ['<x-mini-button primary hover:flat="yellow" focus:outline="green" />'],
    ['<x-mini-button primary hover:flat.yellow focus:outline.green />'],
]);

it('should change the button variant but keep the same color on "hover" or "focus"', function () {
    expect('<x-mini-button primary hover:flat focus:outline />')
        ->render()
        ->toContain(
            (new Solid())->get('primary')->base,
            ...(new Flat())->get('primary')->hover,
            ...(new Outline())->get('primary')->focus,
        )
        ->not()->toContain(
            (new Solid())->get('primary')->hover,
            ...(new Solid())->get('primary')->focus,
        );
});

it('should change the button variant but keep the same color on "interaction"', function () {
    expect('<x-mini-button primary interaction:flat />')
        ->render()
        ->toContain(
            (new Solid())->get('primary')->base,
            ...(new Flat())->get('primary')->hover,
            ...(new Flat())->get('primary')->focus,
        )
        ->not()->toContain(
            (new Solid())->get('primary')->hover,
            ...(new Solid())->get('primary')->focus,
        );
});
