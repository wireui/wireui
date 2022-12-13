<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class Card extends Component
{
    public function __construct(
        public ?string $title = null,
        public ?string $padding = null,
        public ?string $shadow = null,
        public ?string $rounded = null,
        public ?string $color = null,
    ) {
        $this->padding ??= config('wireui.card.padding');
        $this->shadow  ??= config('wireui.card.shadow');
        $this->rounded ??= config('wireui.card.rounded');
        $this->color   ??= config('wireui.card.color');
    }

    public function getCardClasses(): string
    {
        return Arr::toCssClasses([
            'w-full flex flex-col',
            $this->shadow,
            $this->rounded,
            $this->color,
        ]);
    }

    public function getMainClasses(): string
    {
        $default = 'text-secondary-700 rounded-b-xl grow dark:text-secondary-400';

        return Arr::toCssClasses([$default, $this->padding]);
    }

    public function getFooterClasses(): string
    {
        $default = <<<EOT
            px-4 py-4 sm:px-6 bg-secondary-50 rounded-t-none border-t
            dark:bg-secondary-800 dark:border-secondary-600
        EOT;

        return Arr::toCssClasses([$default, $this->rounded]);
    }

    public function render(): View
    {
        return view('wireui::components.card');
    }
}
