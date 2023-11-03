<?php

namespace WireUi\Support;

use Illuminate\Support\Str;

class SafeEval
{
    public const DIRECTIVES_REGEX = '/\B@(@?\w+(?:::\w+)?)([ \t]*)(\( ( (?>[^()]+) | (?3) )* \))?/x';

    private const SECURITY_REPLACES = ['{{{', '}}}', '{{', '}}', '{!!', '!!}', '<?php', '<?=', '<?', '?>'];

    public function evaluate(string $code): string
    {
        return Str::of($code)->replace(self::SECURITY_REPLACES, '')->replaceMatches(self::DIRECTIVES_REGEX, '');
    }
}
