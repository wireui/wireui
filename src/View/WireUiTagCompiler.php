<?php

namespace WireUi\View;

use Illuminate\View\Compilers\ComponentTagCompiler;
use WireUi\Facades\WireUiDirectives;

class WireUiTagCompiler extends ComponentTagCompiler
{
    public function compile($value)
    {
        return $this->compileWireUiSelfClosingTags($value);
    }

    private function compileWireUiSelfClosingTags($value)
    {
        $pattern = '/<\s*wireui\:(scripts|styles)\s*\/?>/';

        return preg_replace_callback($pattern, function (array $matches) {
            $element = '<script>throw new Error("Wrong <wireui:scripts /> usage. It should be <wireui:scripts />")</script>';

            if ($matches[1] === 'scripts') {
                $element = WireUiDirectives::scripts();
            }

            if ($matches[1] === 'styles') {
                $element = WireUiDirectives::styles();
            }

            return $element;
        }, $value);
    }
}
