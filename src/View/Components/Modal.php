<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public string $zIndex;

    public string $maxWidth;

    public string $spacing;

    public ?string $blur;

    public function __construct(
        string $zIndex = 'z-50',
        string $maxWidth = '2xl',
        string $spacing = 'p-4',
        $blur = false
    ) {
        $this->zIndex   = $zIndex;
        $this->spacing  = $spacing;
        $this->maxWidth = $this->getMaxWidth($maxWidth);
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
            '3xl' => 'sm:max-w-2xl',
            '4xl' => 'sm:max-w-2xl',
            '5xl' => 'sm:max-w-2xl',
            '6xl' => 'sm:max-w-2xl',
        ];

        return data_get($classes, $maxWidth, $maxWidth);
    }
}
