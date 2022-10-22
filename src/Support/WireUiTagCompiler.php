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
        $pattern = '/<\s*wireui\:(scripts|styles|external)\s*\/?>/';

        return preg_replace_callback($pattern, function (array $matches) {
            $element = '<script>throw new Error("Wrong <wireui:scripts /> usage. It should be <wireui:scripts />")</script>';

            if ($matches[1] === 'scripts') {
                $element = WireUiDirectives::scripts();
            }

            if ($matches[1] === 'styles') {
                $element = WireUiDirectives::styles();
            }

            if ($matches[1] === 'external') {
                $element = WireUiDirectives::external();
            }

            return $element;
        }, $value);
    }
}
