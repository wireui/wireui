<?php

namespace WireUi\View\Components;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;

class Gravatar extends Avatar
{
    public function __construct(
        public bool $xs = false,
        public bool $sm = false,
        public bool $md = false,
        public bool $lg = false,
        public bool $xl = false,
        public bool $squared = false,
        public ?string $email = null,
        public ?string $default = "blank",
        public ?string $size = null,
        public ?string $label = null,
        public ?string $border = 'border border-gray-200 dark:border-secondary-500',
        public ?string $avatarClasses = null,
    ) {
        parent::__construct($xs, $sm, $md, $lg, $xl, $squared, $size, $label, $border, $avatarClasses);

        if ($email)
            $this->src = $this->getGravatarUrl($email, $default);
    }

    private function getImageSize(): int
    {
        if ($this->xs) return 24;
        if ($this->sm) return 32;
        if ($this->md || $this->shouldUseDefault()) return 40;
        if ($this->lg) return 48;
        if ($this->xl) return 56;
        return 200;
    }

    private function getGravatarUrl($email, $default)
    {
        return  'https://www.gravatar.com/avatar/' .
            md5($email) .
            '?d=' . e($default) . '&s=' . $this->getImageSize();
    }
}
