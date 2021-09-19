<?php

namespace Tests\Unit;

use WireUi\Facades\WireUiDirectives;
use WireUi\Support\WireUiTagCompiler;
use WireUi\WireUiBladeDirectives;

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
        $bladeDirectives = new WireUiBladeDirectives();
        $hooksScript     = $bladeDirectives->hooksScript();

        $scripts = $bladeDirectives->scripts($absolute = false);

        $this->assertEquals(
            "<script>{$hooksScript}</script>",
            $scripts
        );
    }

    /** @test */
    public function it_should_match_rendered_styles_link()
    {
        $bladeDirectives = new WireUiBladeDirectives();
        $expected        = '<link href="/wireui/assets/styles" rel="stylesheet" type="text/css">';

        $this->assertEquals($expected, $bladeDirectives->styles($absolute = false));
    }
}
