<?php

namespace Tests\Unit\Support;

use WireUi\Support\SafeEval;

test('it should assert directives regex matches', function () {
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
});

test('it_should_assert_safe_eval_removes_risk_content', function () {
    $html = <<<'EOT'
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
    EOT;

    $escaped = (new SafeEval())->evaluate($html);

    expect($escaped)->not->toContain('{{{ $variable }}}');
    expect($escaped)->not->toContain('{{ $variable }}');
    expect($escaped)->not->toContain('{!! $variable !!}');
    expect($escaped)->not->toContain('<?php echo "text"; ?>');
    expect($escaped)->not->toContain('<?= "text" ?>');
    expect($escaped)->not->toContain('@directive($first, $second) @endDirective');
    expect($escaped)->not->toContain('@directive() inside content @endDirective @endDirective');
    expect($escaped)->not->toContain('@once');

    expect($escaped)->toContain('$variable');
    expect($escaped)->toContain('echo "text";');
    expect($escaped)->toContain('"text"');
    expect($escaped)->toContain('echo "text"');
    expect($escaped)->toContain('inside content');
});
