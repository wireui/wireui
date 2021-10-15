<?php

namespace WireUi\Controllers;

use Illuminate\Http\{Request, Response};
use Illuminate\View\ComponentAttributeBag;
use WireUi\Support\BladeCompiler;

class ButtonController
{
    private BladeCompiler $compiler;

    public function __construct(BladeCompiler $compiler)
    {
        $this->compiler = $compiler;
    }

    public function render(Request $request): Response
    {
        $attributes = new ComponentAttributeBag($request->all());

        $blade = <<<EOT
            <x-dynamic-component
                :component="WireUiComponent::resolve('button')"
                {$attributes->toHtml()}
            />
        EOT;

        $html = $this->compiler->compile($blade);

        return response($html)->withHeaders([
            'Content-Type'  => 'text/html; charset=utf-8',
            'Cache-Control' => 'public, only-if-cached, max-age=31536000',
        ]);
    }
}
