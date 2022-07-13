<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Blade;
use WireUi\Facades\WireUiDirectives;
use WireUi\Support\{BladeDirectives, WireUiTagCompiler};

class WireUiTagCompilerTest extends UnitTestCase
{
    /** @test */
    public function it_should_match_scripts_and_styles_tags()
    {
        $compiler = resolve(WireUiTagCompiler::class);

        $scripts = $compiler->compile('<wireui:scripts />');
        $this->assertEquals(WireUiDirectives::scripts(), $scripts);

        $scripts = $compiler->compile('<wireui:scripts/>');
        $this->assertEquals(WireUiDirectives::scripts(), $scripts);

        $styles = $compiler->compile('<wireui:styles />');
        $this->assertEquals(WireUiDirectives::styles(), $styles);

        $styles = $compiler->compile('<wireui:styles/>');
        $this->assertEquals(WireUiDirectives::styles(), $styles);
    }

    /** @test */
    public function it_dont_have_matches()
    {
        $compiler = resolve(WireUiTagCompiler::class);

        $foo = $compiler->compile('<wireui:foo />');
        $this->assertEquals($foo, '<wireui:foo />');

        $bar = $compiler->compile('<wireui:bar />');
        $this->assertEquals($bar, '<wireui:bar />');
    }

    /** @test */
    public function it_should_match_rendered_scripts_link()
    {
        $bladeDirectives = new BladeDirectives();
        $hooksScript     = $bladeDirectives->hooksScript();
        $wireuiScript    = '<script src="/wireui/assets/scripts" defer ></script>';

        if ($version = $bladeDirectives->getManifestVersion('wireui.js')) {
            $wireuiScript = str_replace('assets/scripts', "assets/scripts?id={$version}", $wireuiScript);
        }

        $scripts = $bladeDirectives->scripts($absolute = false);

        $this->assertStringContainsString($hooksScript, $scripts);
        $this->assertStringContainsString($wireuiScript, $scripts);
    }

    /** @test */
    public function it_should_match_rendered_styles_link()
    {
        $bladeDirectives = new BladeDirectives();
        $expected        = '<link href="/wireui/assets/styles" rel="stylesheet" type="text/css">';

        if ($version = $bladeDirectives->getManifestVersion('wireui.css')) {
            $expected = str_replace('assets/styles', "assets/styles?id={$version}", $expected);
        }

        $this->assertEquals($expected, $bladeDirectives->styles($absolute = false));
    }

    /**
     * @dataProvider scriptsTagProvider
     */
    public function test_it_should_render_all_wireui_scripts_variation(string $text)
    {
        $html = Blade::render($text);

        $this->assertStringContainsString('<script src="', $html);
        $this->assertStringContainsString('/wireui/assets/scripts', $html);
    }

    public function scriptsTagProvider(): array
    {
        return [
            ['@wireUiScripts'],
            ['@wireUiScripts()'],
            ['@wireUiScripts([])'],
            ["@wireUiScripts(['foo' => 'bar'])"],
            ['<wireui:scripts />'],
        ];
    }
}
