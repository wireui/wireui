<?php

namespace WireUi\View\Components;

abstract class BaseBadge extends Component
{
    public string $pulseColor = 'bg-slate-500';

    public string $pulsePingColor = 'bg-slate-400';

    public function __construct(
        public bool $info = false,
        public bool $warning = false,
        public bool $positive = false,
        public bool $negative = false,
        public bool $dismissible = false,
        public bool $square = false,
        public bool $icon = false,
        public bool $pulse = false,
        public ?string $padding = 'px-2.5 py-0.5',
        public ?string $shadow = null,
        public ?string $rounded = null,
        public ?string $color = 'bg-slate-100 text-slate-800',
        public ?string $title = null,
        public ?string $badgeClasses = null,
    ) {
        $this->getDefaults();
        $this->badgeClasses = $this->getBadgeClasses($badgeClasses);
    }

    public function render()
    {
        return view('wireui::components.badge');
    }
}
