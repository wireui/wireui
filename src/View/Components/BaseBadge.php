<?php

namespace WireUi\View\Components;

abstract class BaseBadge extends Component
{
    public string $pulseColor = 'bg-slate-500';

    public string $pulsePingColor = 'bg-slate-400';

    public string $badgeSize = 'text-xs';

    public string $iconSize = 'w-3 h-3';

    public function __construct(
        public bool $info = false,
        public bool $warning = false,
        public bool $positive = false,
        public bool $negative = false,
        public bool $square = false,
        public bool $lg = false,
        public bool $pulse = false,
        public ?string $padding = '',
        public ?string $shadow = null,
        public ?string $rounded = null,
        public ?string $color = 'bg-slate-100 text-slate-800',
        public ?string $title = null,
        public ?string $icon = null,
        public ?string $badgeClasses = null,
    ) {
        $this->getPulse();
        $this->getSize($lg);
        $this->badgeClasses = $this->getBadgeClasses($badgeClasses);
    }

    public function render()
    {
        return view('wireui::components.badge');
    }

    abstract public function getPulse(): void;

    abstract public function getSize(bool $lg): void;

    abstract public function getBadgeClasses(?string $badgeClasses): string;
}
