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
        public ?bool $borderless = null,
    ) {
        $this->padding    ??= config('wireui.card.padding');
        $this->shadow     ??= config('wireui.card.shadow');
        $this->rounded    ??= config('wireui.card.rounded');
        $this->color      ??= config('wireui.card.color');
        $this->borderless ??= config('wireui.card.borderless');
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

    public function getHeaderClasses(): string
    {
        $border = Arr::toCssClasses(['border-b', $this->borderColor]);

        return Arr::toCssClasses([
            'px-4 py-2.5 flex justify-between items-center',
            $border => !$this->borderless,
        ]);
    }

    public function getTitleClasses(): string
    {
        return Arr::toCssClasses([
            'font-medium text-base whitespace-normal',
            $this->textColor,
        ]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            'rounded-b-xl grow',
            $this->textColor,
            $this->padding,
        ]);
    }

    public function getFooterClasses(): string
    {
        $border = Arr::toCssClasses(['border-t', $this->borderColor]);

        return Arr::toCssClasses([
            'bg-secondary-50 dark:bg-secondary-800',
            'px-4 py-4 sm:px-6 rounded-t-none',
            $border => !$this->borderless,
            $this->rounded,
        ]);
    }

    public function render(): View
    {
        return view('wireui::components.card');
    }
}
