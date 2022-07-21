<?php

namespace WireUi\View\Components;

use Illuminate\Support\Str;

class Avatar extends Component
{
    public function __construct(
        public bool $xs = false,
        public bool $sm = false,
        public bool $md = false,
        public bool $lg = false,
        public bool $xl = false,
        public bool $full = false,
        public bool $squared = false,
        public ?string $label = null,
        public ?string $src = null,
        public ?string $border = 'border border-gray-200 dark:border-secondary-400',
        public ?string $avatarClasses = null,
        public ?string $content = null,
    ) {
        $this->avatarClasses = $this->getAvatarClasses($avatarClasses);
    }

    public function render()
    {
        return 'wireui::components.avatar';
    }

    public function getAvatarClasses(?string $avatarClasses): string
    {
        return $this->classes([
            'items-center justify-center overflow-hidden bg-gray-100 dark:bg-secondary-600',
            'inline-flex' => $this->label,
            'inline-block' => !$this->label,
            'w-6 h-6' => $this->xs,
            'w-8 h-8' => $this->sm,
            'w-10 h-10' => $this->md,
            'w-12 h-12' => $this->lg,
            'w-14 h-14' => $this->xl,
            'w-full h-full' => $this->full,
            'rounded-md' => $this->squared,
            'rounded-full' => !$this->squared,
            $this->border,
            $avatarClasses
        ]);
    }
}
