<?php

namespace WireUi\Support;

use Illuminate\Support\Str;

class SafeEval
{
    private const SECURITY_REPLACES = [
        '{{{',
        '}}}',
        '{{',
        '}}',
        '{!!',
        '!!}',
        '<?php',
        '?>',
        '<?=',
    ];

    public const DIRECTIVES_REGEX = '/\B@(@?\w+(?:::\w+)?)([ \t]*)(\( ( (?>[^()]+) | (?3) )* \))?/x';

    public function evaluate(string $code): string
    {
        return Str::of($code)
            ->replace(self::SECURITY_REPLACES, '')
            ->replaceMatches(self::DIRECTIVES_REGEX, '');
    }
}
