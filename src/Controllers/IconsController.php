<?php

namespace WireUi\Controllers;

class IconsController extends Controller
{
    public function getIcon(string $style, string $icon)
    {
        $iconPath = __DIR__ . "/../../resources/assets/heroicons/{$style}/{$icon}.svg";

        return response()->file($iconPath, [
            'Content-Type'  => 'image/svg+xml; charset=utf-8',
            'Cache-Control' => 'public, only-if-cached',
        ]);
    }
}
