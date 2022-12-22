<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\{Arr, Collection, ViewErrorBag};
use Illuminate\View\Component;

class Errors extends Component
{
    protected string $textColor = 'text-negative-800 dark:text-negative-600';

    protected string $borderColor = 'border-negative-200 dark:border-negative-600';

    public function __construct(
        public ?string $title = null,
        public mixed $only = [],
        public ?string $color = null,
        public ?string $icon = null,
        public ?string $padding = null,
        public ?string $shadow = null,
        public ?string $rounded = null,
        public ?bool $divider = null,
    ) {
        $this->title   ??= trans('wireui::messages.errors.title');
        $this->icon    ??= config('wireui.errors.icon');
        $this->padding ??= config('wireui.errors.padding');
        $this->shadow  ??= config('wireui.errors.shadow');
        $this->rounded ??= config('wireui.errors.rounded');
        $this->color   ??= config('wireui.errors.color');
        $this->divider ??= config('wireui.errors.divider');

        $this->initOnly();
    }

    protected function initOnly(): void
    {
        if (is_string($this->only)) {
            $this->only = str($this->only)->explode('|');

            $this->only->transform(fn (string $name) => trim($name));
        }

        $this->only = collect($this->only);
    }

    public function getErrorMessages(ViewErrorBag $errors): Collection
    {
        return collect($errors->getMessages())->except($this->only);
    }

    public function getCardClasses(): string
    {
        $default = 'w-full flex flex-col dark:border dark:border-negative-600 p-4';

        return Arr::toCssClasses([$default, $this->shadow, $this->rounded, $this->color]);
    }

    public function getHeaderClasses(): string
    {
        $default = 'pb-3 flex items-center';

        $border = Arr::toCssClasses(['border-b-2', $this->borderColor]);

        return Arr::toCssClasses([$default, $border => $this->divider]);
    }

    public function getTitleClasses(): string
    {
        $default = 'font-semibold text-sm whitespace-normal';

        return Arr::toCssClasses([$default, $this->textColor]);
    }

    public function getMainClasses(): string
    {
        $default = 'rounded-b-xl grow';

        return Arr::toCssClasses([$default, $this->padding]);
    }

    public function getFooterClasses(): string
    {
        $default = 'mt-2 pt-2 rounded-t-none';

        $border = Arr::toCssClasses(['border-t-2', $this->borderColor]);

        return Arr::toCssClasses([$default, $this->rounded, $border => $this->divider]);
    }

    public function render(): View
    {
        return view('wireui::components.errors');
    }
}
