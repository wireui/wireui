<?php

namespace WireUi\View\Components;

class CircleBadge extends Badge
{
    public function __construct(
        public bool $rounded = false,
        public bool $squared = false,
        public bool $outline = false,
        public bool $flat = false,
        public bool $full = false,
        public ?string $color = null,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public ?string $prepend = null,
        public ?string $append = null,
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
            prepend: null,
            append: null,
        );
    }

    public function render()
    {
        return function (array $data) {
            return view('wireui::components.circle-badge', $this->mergeData($data))->render();
        };
    }

    public function sizes(): array
    {
        return [
            self::DEFAULT => 'w-6 h-6',
            'md'          => 'w-8 h-8',
            'lg'          => 'w-10 h-10',
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
