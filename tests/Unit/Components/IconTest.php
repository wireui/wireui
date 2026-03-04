<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\{Collection, Str};
use Symfony\Component\Finder\{Finder, SplFileInfo};
use WireUi\View\Components\Icon;

function getIcons(string $style): Collection
{
    $iconsPath = str_replace('.', '/', $style);

    $files = (new Finder())->files()->in(__DIR__ . "/../../../resources/views/components/icons/{$iconsPath}");

    return collect($files)->map(fn (SplFileInfo $file) => [
        'icon'    => Str::before($file->getFilename(), '.blade.php'),
        'style' => $style,
    ]);
}

it('should get the default icon style', function () {
    $icon = new Icon(name: 'house');

    $parsedStyle = $this->invokeMethod($icon, 'getStyle');

    expect($parsedStyle)->toBe('outline');
});

it('should make the outline icon blade view', function () {
    $icon = new Icon(name: 'home', outline: true);

    $view = $icon->render();

    $parsedStyle = $this->invokeMethod($icon, 'getStyle');

    expect($view->name())->toEndWith('components.icons.outline.home');
    expect($parsedStyle)->toBe('outline');
});

it('should make the solid icon blade view', function () {
    $icon = new Icon(name: 'home', solid: true);

    $view = $icon->render();

    $parsedStyle = $this->invokeMethod($icon, 'getStyle');

    expect($view->name())->toEndWith('components.icons.solid.home');
    expect($parsedStyle)->toBe('solid');
});

it('should get the correct icon style', function (string $expected, Icon $icon) {
    $parsedStyle = $this->invokeMethod($icon, 'getStyle');

    expect($parsedStyle)->toBe($expected);
    expect($icon->style)->toBe($expected);

    $view = $icon->render();
    expect($view->name())->toEndWith("components.icons.{$icon->style}.home");
})->with([
    ['outline', new Icon(name: 'home', style: 'outline')],
    ['outline', new Icon(name: 'home', outline: true)],
    ['solid', new Icon(name: 'home', solid: true)],
    ['mini.solid', new Icon(name: 'home', style: 'mini', mini: true)],
    ['mini.solid', new Icon(name: 'home', mini: true)],
    ['micro.solid', new Icon(name: 'home', style: 'micro', micro: true)],
    ['micro.solid', new Icon(name: 'home', micro: true)],
]);

it('should inject the mini style when it is given', function () {
    $icon = new Icon(name: 'home', solid: true, mini: true);

    $style = $this->invokeMethod($icon, 'getStyle');

    expect($style)->toEndWith('mini.solid');
});

it('should inject the micro style when it is given', function () {
    $icon = new Icon(name: 'home', solid: true, micro: true);

    $style = $this->invokeMethod($icon, 'getStyle');

    expect($style)->toEndWith('micro.solid');
});

it('should render all style icons', function (string $style) {
    foreach (getIcons($style) as $data) {
        $icon = $data['icon'];

        $iconStyle = str_replace('/', '.', $style);

        $html = Blade::render(<<<BLADE
            <x-icon name="{$icon}" style="{$iconStyle}" class="w-5 h-5" />
        BLADE);

        $view = (new Icon(name: $icon, style: $iconStyle))->render();

        $expected = Str::replace('/', '.', "wireui::components.icons.{$iconStyle}.{$icon}");

        expect($view->name())->toBe($expected)
            ->and($html)
            ->toContain('<svg')
            ->toContain('</svg>')
            ->toContain('class="w-5 h-5"')
            ->not->toContain('<x-icon');
    }
})->with([
    'outline',
    'solid',
    'mini.solid',
    'micro.solid',
]);
