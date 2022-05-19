<?php

namespace WireUi\Http\Controllers;

use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class IconsController extends Controller
{
    public function __invoke(string $style, string $icon)
    {
        $view = "wireui::components.icons.{$style}.{$icon}";

        abort_unless(View::exists($view), Response::HTTP_NOT_FOUND, "Icon \"{$icon}\" not found.");

        return response()
            ->view($view, ['attributes' => null])
            ->withHeaders([
                'Content-Type'  => 'image/svg+xml; charset=utf-8',
                'Cache-Control' => 'public, only-if-cached, max-age=31536000',
            ]);
    }
}
