<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class Card extends Component
{
    protected string $textColor = 'text-secondary-700 dark:text-secondary-400';

    protected string $borderColor = 'border-secondary-200 dark:border-secondary-600';

    public function __construct(
        public ?string $title = null,
        public ?string $padding = null,
        public ?string $shadow = null,
        public ?string $rounded = null,
        public ?string $color = null,
        public ?bool $divider = null,
    ) {
        $this->padding ??= config('wireui.card.padding');
        $this->shadow  ??= config('wireui.card.shadow');
        $this->rounded ??= config('wireui.card.rounded');
        $this->color   ??= config('wireui.card.color');
        $this->divider ??= config('wireui.card.divider');
    }

    public function getCardClasses(): string
    {
        $default = 'w-full flex flex-col';

        return Arr::toCssClasses([$default, $this->shadow, $this->rounded, $this->color]);
    }

    public function getHeaderClasses(): string
    {
        $default = 'px-4 py-2.5 flex justify-between items-center';

        $border = Arr::toCssClasses(['border-b', $this->borderColor]);

        return Arr::toCssClasses([$default, $border => $this->divider]);
    }

    public function getTitleClasses(): string
    {
        $default = 'font-medium text-base whitespace-normal';

        return Arr::toCssClasses([$default, $this->textColor]);
    }

    public function getMainClasses(): string
    {
        $default = 'rounded-b-xl grow';

        return Arr::toCssClasses([$default, $this->textColor, $this->padding]);
    }

    public function getFooterClasses(): string
    {
        $default = 'px-4 py-4 sm:px-6 rounded-t-none';

        $footerColor = 'bg-secondary-50 dark:bg-secondary-800';

        $default = Arr::toCssClasses([$default, $footerColor]);

        $border = Arr::toCssClasses(['border-t', $this->borderColor]);

        return Arr::toCssClasses([$default, $this->rounded, $border => $this->divider]);
    }

    public function render(): View
    {
        return view('wireui::components.card');
    }
}
