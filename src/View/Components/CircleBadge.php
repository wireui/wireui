<?php

namespace WireUi\View\Components;

use Closure;

class CircleBadge extends Badge
{
    public function __construct(
        public bool $outline = false,
        public bool $flat = false,
        public ?string $color = null,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $icon = null,
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
        );
    }

    public function render(): Closure
    {
        return function (array $data) {
            return view('wireui::components.circle-badge', $this->mergeData($data))->render();
        };
    }

    public function sizes(): array
    {
        return [
            self::DEFAULT => 'w-6 h-6',
            'md'          => 'w-7 h-7',
            'lg'          => 'w-8 h-8',
        ];
    }

    public function iconSizes(): array
    {
        return [
            self::DEFAULT => 'w-3 h-3',
            'md'          => 'w-4 h-4',
            'lg'          => 'w-5 h-5',
        ];
    }
}
