<?php

namespace WireUi\View\Components;

class CircleButton extends Button
{
    public function __construct(
        bool $rounded = true,
        bool $squared = false,
        bool $outline = false,
        bool $flat = false,
        ?string $color = null,
        ?string $size = null,
        ?string $label = null,
        ?string $icon = null,
        ?string $rightIcon = null,
        ?string $spinner = null,
        ?string $loadingDelay = null
    ) {
        parent::__construct(
            $rounded = true,
            $squared = false,
            $outline,
            $flat,
            $color,
            $size,
            $label,
            $icon,
            $rightIcon = null,
            $spinner,
            $loadingDelay
        );
    }

    public function render()
    {
        return function (array $data) {
            return view('wireui::components.circle-button', $this->mergeData($data))->render();
        };
    }

    protected function sizes(): array
    {
        return [
            '2xs'         => 'w-5 h-5',
            'xs'          => 'w-7 h-7',
            'sm'          => 'w-8 h-8',
            self::DEFAULT => 'w-9 h-9',
            'md'          => 'w-10 h-10',
            'lg'          => 'w-12 h-12',
            'xl'          => 'w-14 h-14',
        ];
    }

    protected function iconSizes(): array
    {
        return [
            '2xs'         => 'w-2 h-2',
            'xs'          => 'w-3 h-3',
            'sm'          => 'w-3.5 h-3.5',
            self::DEFAULT => 'w-4 h-4',
            'md'          => 'w-4 h-4',
            'lg'          => 'w-5 h-5',
            'xl'          => 'w-6 h-6',
        ];
    }
}
