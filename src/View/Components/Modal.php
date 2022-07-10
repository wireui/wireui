<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $zIndex = null,
        public ?string $maxWidth = null,
        public ?string $spacing = null,
        public ?string $align = null,
        public string|bool|null $blur = null,
        public bool $show = false
    ) {
        $zIndex   ??= config('wireui.modal.zIndex');
        $maxWidth ??= config('wireui.modal.maxWidth');
        $spacing  ??= config('wireui.modal.spacing');
        $align    ??= config('wireui.modal.align');
        $blur     ??= config('wireui.modal.blur');

        $this->zIndex   = $zIndex;
        $this->spacing  = $spacing;
        $this->maxWidth = $this->getMaxWidth($maxWidth);
        $this->align    = $this->getAlign($align);
        $this->blur     = $this->getBlur($blur);
    }

    public function render()
    {
        return view('wireui::components.modal');
    }

    private function getBlur($blur): ?string
    {
        if (!$blur) {
            return null;
        }

        return match ($blur) {
            'sm'    => 'backdrop-blur-sm',
            'md'    => 'backdrop-blur-md',
            'lg'    => 'backdrop-blur-lg',
            'xl'    => 'backdrop-blur-xl',
            '2xl'   => 'backdrop-blur-2xl',
            '3xl'   => 'backdrop-blur-3xl',
            default => 'backdrop-blur'
        };
    }

    private function getMaxWidth(string $maxWidth): string
    {
        return match ($maxWidth) {
            'sm'    => 'sm:max-w-sm',
            'md'    => 'sm:max-w-md',
            'lg'    => 'sm:max-w-lg',
            'xl'    => 'sm:max-w-xl',
            '2xl'   => 'sm:max-w-2xl',
            '3xl'   => 'sm:max-w-3xl',
            '4xl'   => 'sm:max-w-4xl',
            '5xl'   => 'sm:max-w-5xl',
            '6xl'   => 'sm:max-w-6xl',
            '7xl'   => 'sm:max-w-7xl',
            default => $maxWidth
        };
    }

    public function getAlign(string $align): string
    {
        return match ($align) {
            'start'  => 'sm:items-start',
            'center' => 'sm:items-center',
            'end'    => 'sm:items-end',
            default  => $align
        };
    }
}
