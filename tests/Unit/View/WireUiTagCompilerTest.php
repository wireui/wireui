<?php

namespace Tests\Unit\View;

use WireUi\Facades\WireUiDirectives;
use WireUi\Support\BladeDirectives;
use WireUi\View\WireUiTagCompiler;

test('it should match scripts and styles tags', function () {
    $compiler = resolve(WireUiTagCompiler::class);

    $scripts = $compiler->compile('<wireui:scripts />');
    expect($scripts)->toBe(WireUiDirectives::scripts());

    $scripts = $compiler->compile('<wireui:scripts/>');
    expect($scripts)->toBe(WireUiDirectives::scripts());

    $styles = $compiler->compile('<wireui:styles />');
    expect($styles)->toBe(WireUiDirectives::styles());

    $styles = $compiler->compile('<wireui:styles/>');
    expect($styles)->toBe(WireUiDirectives::styles());
});

test('it dont have matches', function () {
    $compiler = resolve(WireUiTagCompiler::class);

    $foo = $compiler->compile('<wireui:foo />');
    expect($foo)->toBe('<wireui:foo />');

    $bar = $compiler->compile('<wireui:bar />');
    expect($bar)->toBe('<wireui:bar />');
});

test('it should match rendered scripts link', function () {
    $bladeDirectives = new BladeDirectives;

    $hooksScript = $bladeDirectives->hooksScript();

    $wireuiScript = '<script src="/wireui/assets/scripts" defer ></script>';

    if ($version = $bladeDirectives->getManifestVersion('wireui.js')) {
        $wireuiScript = str_replace('assets/scripts', "assets/scripts?id={$version}", $wireuiScript);
    }

    $scripts = $bladeDirectives->scripts($absolute = false);

    expect($scripts)->toContain($hooksScript);

    expect($scripts)->toContain($wireuiScript);
});

test('it should match rendered styles link', function () {
    $bladeDirectives = new BladeDirectives;

    $expected = '<link href="/wireui/assets/styles" rel="stylesheet" type="text/css">';

    if ($version = $bladeDirectives->getManifestVersion('wireui.css')) {
        $expected = str_replace('assets/styles', "assets/styles?id={$version}", $expected);
    }

    expect($bladeDirectives->styles($absolute = false))->toBe($expected);
});

test('it should render all wireui scripts variation', function (string $text) {
    $html = render($text);

    expect($html)->toContain('<script src="');

    expect($html)->toContain('/wireui/assets/scripts');
})->with('wireui::scripts');
