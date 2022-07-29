<?php

namespace WireUi\View\Components;

class Avatar extends Component
{
    public function __construct(
        public bool $xs = false,
        public bool $sm = false,
        public bool $md = false,
        public bool $lg = false,
        public bool $xl = false,
        public bool $squared = false,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $src = null,
        public ?string $border = 'border border-gray-200 dark:border-secondary-500',
        public ?string $avatarClasses = null,
    ) {
        $this->size ??= $this->getSize();
        $this->avatarClasses = $this->getAvatarClasses();
    }

    public function render()
    {
        return view('wireui::components.avatar');
    }

    public function getAvatarClasses(): string
    {
        return $this->classes([
            'shrink-0 inline-flex items-center justify-center overflow-hidden',
            "bg-gray-500 dark:bg-gray-600" => $this->label,
            'rounded-md'                   => $this->squared,
            'rounded-full'                 => !$this->squared,
            $this->size                    => $this->label || !$this->src,
            $this->border
        ]);
    }

    private function getSize(): string
    {
        return $this->classes([
            'w-6 h-6 text-2xs'    => $this->xs,
            'w-8 h-8 text-sm'     => $this->sm,
            'w-10 h-10 text-base' => $this->md || $this->shouldUseDefault(),
            'w-12 h-12 text-lg'   => $this->lg,
            'w-14 h-14 text-xl'   => $this->xl,
        ]);
    }

    private function shouldUseDefault(): bool
    {
        return !$this->xs && !$this->sm && !$this->lg && !$this->xl;
    }
}
