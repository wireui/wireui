<?php

namespace Tests\Unit;

use WireUi\Support\SafeEval;

class SafeEvalTest extends UnitTestCase
{
    /** @test */
    public function it_should_assert_directives_regex_matches()
    {
        $blade = '
        <div>
            @if(true) @endif
            @directive()
            @once
        </div>
        ';

        $matches = [];

        preg_match_all(SafeEval::DIRECTIVES_REGEX, $blade, $matches);

        $this->assertCount(4, $matches[0]);
    }

    /** @test */
    public function it_should_assert_safe_eval_removes_risk_content()
    {
        $html = '
            {{{ $variable }}}
            {{ $variable }}
            {!! $variable !!}
            <?php echo "text"; ?>
            <?= "text" ?>
            <? echo "text" ?>

            @directive() @endDirective
            @directive($first, $second) @endDirective
            @directive() inside content @endDirective @endDirective
            @once
        ';

        $escaped = (new SafeEval())->evaluate($html);

        $this->assertStringNotContainsString('{{{ $variable }}}', $escaped);
        $this->assertStringNotContainsString('{{ $variable }}', $escaped);
        $this->assertStringNotContainsString('{!! $variable !!}', $escaped);
        $this->assertStringNotContainsString('<?php echo "text"; ?>', $escaped);
        $this->assertStringNotContainsString('<?= "text" ?>', $escaped);
        $this->assertStringNotContainsString('@directive($first, $second) @endDirective', $escaped);
        $this->assertStringNotContainsString('@directive() inside content @endDirective @endDirective', $escaped);
        $this->assertStringNotContainsString('@once', $escaped);

        $this->assertStringContainsString('$variable', $escaped);
        $this->assertStringContainsString('echo "text";', $escaped);
        $this->assertStringContainsString('"text"', $escaped);
        $this->assertStringContainsString('echo "text"', $escaped);
        $this->assertStringContainsString('inside content', $escaped);
    }
}
