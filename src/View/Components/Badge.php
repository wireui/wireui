<?php

namespace WireUi\View\Components;

class Badge extends BaseBadge
{
    public function getPulse(): void
    {
        if ($this->info) {
            $this->setPulseAttributes('bg-info-500', 'bg-info-400');
        }
        if ($this->warning) {
            $this->setPulseAttributes('bg-warning-500', 'bg-warning-400');
        }
        if ($this->positive) {
            $this->setPulseAttributes('bg-positive-500', 'bg-positive-400');
        }
        if ($this->negative) {
            $this->setPulseAttributes('bg-negative-500', 'bg-negative-400');
        }
    }

    private function setPulseAttributes($pulseColor, $pingColor)
    {
        $this->pulseColor = $this->classes([
            'relative inline-flex rounded-full h-2 w-2',
            $pulseColor,
        ]);
        $this->pulsePingColor = $this->classes([
            'animate-ping absolute inline-flex h-full w-full rounded-full opacity-75',
            $pingColor
        ]);
    }

    public function getSize(bool $lg): void
    {
        if ($lg) {
            $this->badgeSize = 'text-sm';
            $this->iconSize = 'h-4 w-4';
        }
    }

    public function getBadgeClasses(?string $badgeClasses): string
    {
        return $this->classes([
            'relative inline-flex items-center font-medium',
            $this->badgeSize,
            $this->padding,
            $this->shadow,
            $this->rounded,
            $this->color,
            'rounded'                           => $this->square,
            'rounded-full'                      => !$this->square,
            'p-1.5'                             => $this->icon,
            'px-2.5 py-0.5'                     => !$this->icon,
            'bg-info-100 text-info-800'         => $this->info,
            'bg-warning-100 text-warning-800'   => $this->warning,
            'bg-positive-100 text-positive-800' => $this->positive,
            'bg-negative-100 text-negative-800' => $this->negative,
            $badgeClasses,
        ]);
    }
}
