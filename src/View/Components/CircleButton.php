<?php

namespace WireUi\View\Components;

use Closure;

class CircleButton extends Button
{
    public function __construct(
        public bool $rounded = true,
        public bool $squared = false,
        public bool $outline = false,
        public bool $flat = false,
        public bool $full = false,
        public ?string $color = null,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public ?string $spinner = null,
        public ?string $loadingDelay = null,
        public ?string $href = null
    ) {
        parent::__construct(
            rounded: true,
            squared: false,
            outline: $outline,
            flat: $flat,
            full: false,
            color: $color,
            size: $size,
            label: $label,
            icon: $icon,
            rightIcon: null,
            spinner: $spinner,
            loadingDelay: $loadingDelay,
            href: $href
        );
    }

    public function render(): Closure
    {
        return function (array $data) {
            return view('wireui::components.circle-button', $this->mergeData($data))->render();
        };
    }

    public function sizes(): array
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

    public function iconSizes(): array
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
