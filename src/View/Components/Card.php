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
        $this->padding = $padding ??= config('wireui.card.padding');
        $this->shadow  = $shadow  ??= config('wireui.card.shadow');
        $this->rounded = $rounded ??= config('wireui.card.rounded');
        $this->color   = $color   ??= config('wireui.card.color');
    }

    public function getCardClasses(): string
    {
        return Arr::toCssClasses(['w-full flex flex-col', $this->shadow, $this->rounded, $this->color]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses(['text-secondary-700 rounded-b-xl grow dark:text-secondary-400', $this->padding]);
    }

    public function getFooterClasses(): string
    {
        return Arr::toCssClasses(['px-4 py-4 sm:px-6 bg-secondary-50 rounded-t-none border-t dark:bg-secondary-800 dark:border-secondary-600', $this->rounded]);
    }

    public function render(): View
    {
        return view('wireui::components.card');
    }
}
