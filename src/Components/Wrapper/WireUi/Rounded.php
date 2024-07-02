<?php

namespace WireUi\Components\Wrapper\WireUi;

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
                'input' => 'rounded-none',
                'prepend' => 'rounded-none',
                'append' => 'rounded-none',
            ],
            Packs\Rounded::SM => [
                'input' => 'rounded-sm',
                'prepend' => 'rounded-l-sm',
                'append' => 'rounded-r-sm',
            ],
            Packs\Rounded::BASE => [
                'input' => 'rounded',
                'prepend' => 'rounded-l',
                'append' => 'rounded-r',
            ],
            Packs\Rounded::MD => [
                'input' => 'rounded-md',
                'prepend' => 'rounded-l-md',
                'append' => 'rounded-r-md',
            ],
            Packs\Rounded::LG => [
                'input' => 'rounded-lg',
                'prepend' => 'rounded-l-lg',
                'append' => 'rounded-r-lg',
            ],
            Packs\Rounded::XL => [
                'input' => 'rounded-xl',
                'prepend' => 'rounded-l-xl',
                'append' => 'rounded-r-xl',
            ],
            Packs\Rounded::XL2 => [
                'input' => 'rounded-2xl',
                'prepend' => 'rounded-l-2xl',
                'append' => 'rounded-r-2xl',
            ],
            Packs\Rounded::XL3 => [
                'input' => 'rounded-3xl',
                'prepend' => 'rounded-l-3xl',
                'append' => 'rounded-r-3xl',
            ],
            Packs\Rounded::FULL => [
                'input' => 'rounded-full',
                'prepend' => 'rounded-l-full',
                'append' => 'rounded-r-full',
            ],
        ];
    }
}
