<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Badge extends Component
{
    public bool $info = false;

    public bool $warning = false;

    public bool $success = false;

    public bool $danger = false;

    public bool $close = false;

    public bool $square = false;

    public bool $icon = false;

    public ?string $padding;

    public ?string $shadow;

    public ?string $rounded;

    public ?string $color;

    public ?string $name;

    public ?string $badgeClasses = '';

    public function __construct(
        bool $info = false,
        bool $warning = false,
        bool $success = false,
        bool $danger = false,
        bool $close = false,
        bool $square = false,
        bool $icon = false,
        ?string $padding = 'px-2.5 py-0.5',
        ?string $shadow = '',
        ?string $rounded = 'rounded-full',
        ?string $color = 'bg-gray-100 text-gray-800',
        ?string $name = null,
        ?string $badgeClasses = '',
    ) {
        $this->info = $info;
        $this->warning = $warning;
        $this->success = $success;
        $this->danger = $danger;
        $this->close = $close;
        $this->square = $square;
        $this->icon = $icon;
        $this->padding = $padding;
        $this->shadow = $shadow;
        $this->rounded = $rounded;
        $this->color = $color;
        $this->name = $name;
        $this->badgeClasses = $this->setBadgeClasses($badgeClasses);
    }

    public function setBadgeClasses(?string $badgeClasses): string
    {
        return Str::of('inline-flex items-center text-xs font-medium')
            ->append(" {$this->padding}")
            ->append(" {$this->shadow}")
            ->append(" {$this->rounded}")
            ->append(" {$this->color}")
            ->when($this->square, function ($string) {
                return $string->replace('rounded-full', 'rounded');
            })
            ->when($this->icon, function ($string) {
                return $string->replace('px-2.5 py-0.5', 'p-1.5');
            })
            ->when($this->info, function ($string) {
                return $string->replace('bg-gray-100 text-gray-800', 'bg-blue-100 text-blue-800');
            })
            ->when($this->warning, function ($string) {
                return $string->replace('bg-gray-100 text-gray-800', 'bg-yellow-100 text-yellow-800');
            })
            ->when($this->success, function ($string) {
                return $string->replace('bg-gray-100 text-gray-800', 'bg-green-100 text-green-800');
            })
            ->when($this->danger, function ($string) {
                return $string->replace('bg-gray-100 text-gray-800', 'bg-red-100 text-red-800');
            })
            ->append(" {$badgeClasses}");
    }

    public function render()
    {
        return view('wireui::components.badge');
    }
}
