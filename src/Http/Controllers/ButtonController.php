<?php

namespace WireUi\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Http\Requests\ButtonRequest;

class ButtonController extends Controller
{
    public function __invoke(ButtonRequest $request): Response
    {
        $blade = <<<'BLADE'
            <x-dynamic-component
                :component="WireUi::component('button')"
                :attributes="$attributes"
            />
        BLADE;

        $attributes = new ComponentAttributeBag($request->validated());

        $html = Blade::render($blade, ['attributes' => $attributes]);

        return response($html)->withHeaders([
            'Content-Type' => 'text/html; charset=utf-8',
            'Cache-Control' => 'public, only-if-cached, max-age=31536000',
            'Content-Security-Policy' => "default-src 'self'; script-src 'none';",
        ]);
    }
}
