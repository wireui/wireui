<?php

namespace WireUi\View\Components;

use Illuminate\Support\Str;

class Avatar extends Component
{
    public bool $xs = false;

    public bool $sm = false;

    public bool $md = false;

    public bool $lg = false;

    public bool $xl = false;

    public bool $full = false;

    public bool $squared = false;

    public bool $text = false;

    public ?string $border = '';

    public ?string $avatarClasses = '';

    public ?string $content;

    public function __construct(
        bool $xs = false,
        bool $sm = false,
        bool $md = false,
        bool $lg = false,
        bool $xl = false,
        bool $full = false,
        bool $squared = false,
        bool $text = false,
        ?string $border = null,
        ?string $avatarClasses = '',
        string $content = null
    ) {
        $this->xs = $xs;
        $this->sm = $sm;
        $this->md = $md;
        $this->lg = $lg;
        $this->xl = $xl;
        $this->full = $full;
        $this->squared = $squared;
        $this->text = $text;
        $this->border = ($border) ? 'border border-gray-200 dark:border-secondary-400' : '';
        $this->avatarClasses = $this->setAvatarClasses($avatarClasses);
        $this->content = $content;
    }

    public function setAvatarClasses(?string $avatarClasses): string
    {
        return Str::of('items-center justify-center overflow-hidden bg-gray-100 dark:bg-secondary-600')
            ->when($this->text, function ($string) {
                return $string->append(' inline-flex');
            })
            ->when(!$this->text, function ($string) {
                return $string->append(' inline-block');
            })
            ->when($this->xs, function ($string) {
                return $string->append(' w-6 h-6');
            })
            ->when($this->sm, function ($string) {
                return $string->append(' w-8 h-8');
            })
            ->when($this->md, function ($string) {
                return $string->append(' w-10 h-10');
            })
            ->when($this->lg, function ($string) {
                return $string->append(' w-12 h-12');
            })
            ->when($this->xl, function ($string) {
                return $string->append(' w-14 h-14');
            })
            ->when($this->full, function ($string) {
                return $string->append(' w-full h-full');
            })
            ->when(!$this->squared, function ($string) {
                return $string->append(' rounded-full');
            })
            ->when($this->squared, function ($string) {
                return $string->append(' rounded-md');
            })
            ->append(" {$this->border}")
            ->append(" {$avatarClasses}");
    }

    public function render()
    {
        return 'wireui::components.avatar';
    }
}
