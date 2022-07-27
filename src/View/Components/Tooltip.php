<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Tooltip extends Component
{
    private array $themes = ['light', 'light-border', 'material', 'translucent'];

    private array $triggers = ['mouseenter focus', 'click', 'focusin', 'mouseenter click', 'manual'];

    private array $placements = ['top', 'top-start', 'top-end', 'right', 'right-start', 'right-end', 'bottom', 'bottom-start', 'bottom-end', 'left', 'left-start', 'left-end'];

    private array $animations = ['shift-away', 'shift-away-subtle', 'shift-away-extreme', 'scale', 'scale-subtle', 'scale-extreme', 'shift-toward', 'shift-toward-subtle', 'shift-toward-extreme', 'perspective', 'perspective-subtle', 'perspective-extreme'];

    public function __construct(
        public bool $arrow = true,
        public ?int $timeout = 2000,
        public ?string $message = null,
        public string $placement = 'top',
        public string $animation = 'scale',
        public string $theme = 'translucent',
        public string $trigger = 'mouseenter focus',
    ) {
        $this->theme     = $this->getTheme($theme);
        $this->trigger   = $this->getTrigger($trigger);
        $this->animation = $this->getAnimation($animation);
        $this->placement = $this->getPlacement($placement);
    }

    public function render()
    {
        return view('wireui::components.tooltip');
    }

    private function getTheme(string $theme): string
    {
        return collect($this->themes)->contains($theme) ? $theme : 'translucent';
    }

    private function getPlacement(string $placement): string
    {
        return collect($this->placements)->contains($placement) ? $placement : 'top';
    }

    private function getAnimation(string $animation): string
    {
        return collect($this->animations)->contains($animation) ? $animation : 'scale';
    }

    private function getTrigger(string $trigger): string
    {
        return collect($this->triggers)->contains($trigger) ? $trigger : 'mouseenter focus';
    }
}
