<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public string $zIndex;

    public string $maxWidth;

    public string $spacing;

    public string $align;

    public ?string $blur;

    public function __construct(
        ?string $zIndex = null,
        ?string $maxWidth = null,
        ?string $spacing = null,
        ?string $align = null,
        $blur = null
    ) {
        $zIndex   ??= config('wireui.modal.zIndex');
        $maxWidth ??= config('wireui.modal.maxWidth');
        $spacing  ??= config('wireui.modal.spacing');
        $align    ??= config('wireui.modal.align');

        if ($blur === null) {
            $blur = config('wireui.modal.blur');
        }

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

        $classes = [
            'sm'  => 'backdrop-blur-sm',
            'md'  => 'backdrop-blur-md',
            'lg'  => 'backdrop-blur-lg',
            'xl'  => 'backdrop-blur-xl',
            '2xl' => 'backdrop-blur-2xl',
            '3xl' => 'backdrop-blur-3xl',
        ];

        return data_get($classes, $blur, 'backdrop-blur');
    }

    private function getMaxWidth(string $maxWidth): string
    {
        $classes = [
            'sm'  => 'sm:max-w-sm',
            'md'  => 'sm:max-w-md',
            'lg'  => 'sm:max-w-lg',
            'xl'  => 'sm:max-w-xl',
            '2xl' => 'sm:max-w-2xl',
            '3xl' => 'sm:max-w-3xl',
            '4xl' => 'sm:max-w-4xl',
            '5xl' => 'sm:max-w-5xl',
            '6xl' => 'sm:max-w-6xl',
        ];

        return data_get($classes, $maxWidth, $maxWidth);
    }

    public function getAlign(string $align): string
    {
        $classes = [
            'start'  => 'sm:items-start',
            'center' => 'sm:items-center',
            'end'    => 'sm:items-end',
        ];

        return data_get($classes, $align, $align);
    }
}
