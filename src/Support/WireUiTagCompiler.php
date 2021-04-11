<?php

namespace WireUi\Support;

use Illuminate\View\Compilers\ComponentTagCompiler;
use WireUi\Facades\WireUiDirectives;

class WireUiTagCompiler extends ComponentTagCompiler
{
    public function compile($value)
    {
        return $this->compileWireUiSelfClosingTags($value);
    }

    protected function compileWireUiSelfClosingTags($value)
    {
        $pattern = '<\s*wireui\:(scripts|styles)\s*\/?>';

        return preg_replace_callback($pattern, function (array $matches) {
            if ($matches[1] === 'scripts') {
                $element = WireUiDirectives::scripts();
            }

            if ($matches[1] === 'styles') {
                $element = WireUiDirectives::styles();
            }

            return trim($element, '<>');
        }, $value);
    }
}
