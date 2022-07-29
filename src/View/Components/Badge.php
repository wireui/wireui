<?php

namespace WireUi\View\Components;

class Badge extends BaseBadge
{
    public function getDefaults()
    {
        if ($this->info) {
            $this->color = 'bg-info-100 text-info-800';
            if ($this->pulse) {
                $this->pulseColor = 'bg-info-500';
                $this->pulsePingColor = 'bg-info-400';
            }
        }

        if ($this->warning) {
            $this->color = 'bg-warning-100 text-warning-800';
            if ($this->pulse) {
                $this->pulseColor = 'bg-warning-500';
                $this->pulsePingColor = 'bg-warning-400';
            }
        }

        if ($this->positive) {
            $this->color = 'bg-positive-100 text-positive-800';
            if ($this->pulse) {
                $this->pulseColor = 'bg-positive-500';
                $this->pulsePingColor = 'bg-positive-400';
            }
        }

        if ($this->negative) {
            $this->color = 'bg-negative-100 text-negative-800';
            if ($this->pulse) {
                $this->pulseColor = 'bg-negative-500';
                $this->pulsePingColor = 'bg-negative-400';
            }
        }
    }

    public function getBadgeClasses(?string $badgeClasses): string
    {
        return $this->classes([
            'relative inline-flex items-center text-xs font-medium',
            $this->padding,
            $this->shadow,
            $this->rounded,
            $this->color,
            $badgeClasses,
            'rounded'       => $this->square,
            'rounded-full'  => !$this->square,
            'p-1.5'         => $this->icon,
            'px-2.5 py-0.5' => !$this->icon,
            
        ]);
    }
}
