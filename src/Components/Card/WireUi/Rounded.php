<?php

namespace WireUi\Components\Card\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Rounded extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.style.rounded') ?? Packs\Rounded::BASE;
    }

    public function all(): array
    {
        return [
            Packs\Rounded::NONE => [
                'root' => 'rounded-none',
                'header' => 'rounded-t-none',
                'footer' => 'rounded-b-none',
            ],
            Packs\Rounded::SM => [
                'root' => 'rounded-sm',
                'header' => 'rounded-t-sm',
                'footer' => 'rounded-b-sm',
            ],
            Packs\Rounded::BASE => [
                'root' => 'rounded',
                'header' => 'rounded-t',
                'footer' => 'rounded-b',
            ],
            Packs\Rounded::MD => [
                'root' => 'rounded-md',
                'header' => 'rounded-t-md',
                'footer' => 'rounded-b-md',
            ],
            Packs\Rounded::LG => [
                'root' => 'rounded-lg',
                'header' => 'rounded-t-lg',
                'footer' => 'rounded-b-lg',
            ],
            Packs\Rounded::XL => [
                'root' => 'rounded-xl',
                'header' => 'rounded-t-xl',
                'footer' => 'rounded-b-xl',
            ],
            Packs\Rounded::XL2 => [
                'root' => 'rounded-2xl',
                'header' => 'rounded-t-2xl',
                'footer' => 'rounded-b-2xl',
            ],
            Packs\Rounded::XL3 => [
                'root' => 'rounded-3xl',
                'header' => 'rounded-t-3xl',
                'footer' => 'rounded-b-3xl',
            ],
            Packs\Rounded::FULL => [
                'root' => 'rounded-3xl',
                'header' => 'rounded-t-3xl',
                'footer' => 'rounded-b-3xl',
            ],
        ];
    }
}
