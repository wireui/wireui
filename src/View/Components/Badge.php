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

    public bool $pulse = false;

    public ?string $padding;

    public ?string $shadow;

    public ?string $rounded;

    public ?string $color;

    public ?string $name;

    public ?string $badgeClasses = '';

    public string $pulseColor = 'bg-slate-500';

    public string $pulsePingColor = 'bg-slate-400';

    public function __construct(
        bool $info = false,
        bool $warning = false,
        bool $success = false,
        bool $danger = false,
        bool $close = false,
        bool $square = false,
        bool $icon = false,
        bool $pulse = false,
        ?string $padding = 'px-2.5 py-0.5',
        ?string $shadow = '',
        ?string $rounded = 'rounded-full',
        ?string $color = 'bg-slate-100 text-slate-800',
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
        $this->pulse = $pulse;
        $this->padding = $padding;
        $this->shadow = $shadow;
        $this->rounded = $rounded;
        $this->color = $color;
        $this->name = $name;
        $this->badgeClasses = $this->setBadgeClasses($badgeClasses);
        $this->setPulse($pulse);
    }

    public function setBadgeClasses(?string $badgeClasses): string
    {
        return Str::of('relative inline-flex items-center text-xs font-medium')
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
                return $string->replace('bg-slate-100 text-slate-800', 'bg-info-100 text-info-800');
            })
            ->when($this->warning, function ($string) {
                return $string->replace('bg-slate-100 text-slate-800', 'bg-warning-100 text-warning-800');
            })
            ->when($this->success, function ($string) {
                return $string->replace('bg-slate-100 text-slate-800', 'bg-positive-100 text-positive-800');
            })
            ->when($this->danger, function ($string) {
                return $string->replace('bg-slate-100 text-slate-800', 'bg-negative-100 text-negative-800');
            })
            ->append(" {$badgeClasses}");
    }

    public function setPulse($pulse)
    {
        if ($pulse) {
            if ($this->info) {
                $this->pulseColor = 'bg-info-500';
                $this->pulsePingColor = 'bg-info-400';
            }
            if ($this->warning) {
                $this->pulseColor = 'bg-warning-500';
                $this->pulsePingColor = 'bg-warning-400';
            }
            if ($this->success) {
                $this->pulseColor = 'bg-positive-500';
                $this->pulsePingColor = 'bg-positive-400';
            }
            if ($this->danger) {
                $this->pulseColor = 'bg-negative-500';
                $this->pulsePingColor = 'bg-negative-400';
            }
        }
    }

    public function render()
    {
        return view('wireui::components.badge');
    }
}
