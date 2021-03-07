<?php

namespace WireUi\App\Http\Controllers;

class IconsController extends Controller
{
    public function getIcon(string $icon, ?string $style = null)
    {
        $style    = $style ?: config('wireui.icons.style');
        $iconPath = __DIR__ . "/../../../resources/assets/heroicons/{$style}/{$icon}.svg";

        return response()->file($iconPath, [
            'Content-Type'  => 'image/svg+xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}
