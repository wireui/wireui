<?php

namespace WireUi\View\Components;

use Closure;
use Illuminate\Support\{Arr, HtmlString};
use Illuminate\View\Component;
use WireUi\Traits\HasModifiers;

class Alert extends Component
{
    use HasModifiers;

    public function __construct(
        public ?string $title = null,
        public ?string $icon = null,
        public ?string $padding = null,
        public ?string $shadow = null,
        public ?string $rounded = null,
        public ?string $color = null,
        public ?bool $undivided = null,
        public ?bool $iconless = false,
    ) {
        $this->padding   ??= config('wireui.alert.padding');
        $this->shadow    ??= config('wireui.alert.shadow');
        $this->rounded   ??= config('wireui.alert.rounded');
        $this->undivided ??= config('wireui.alert.undivided');
    }

    protected function setupData(array $data): array
    {
        /** @var DataPack $dataPack */
        $dataPack = resolve(config('wireui.alert.values'));

        $this->color ??= $this->getMatchModifier($dataPack->keys());
        $this->color ??= config('wireui.alert.color');

        $values = (array) json_decode($dataPack->get($this->color));

        $values['icon'] = $this->icon ?? $values['icon'];

        return array_merge($data, ['values' => $values]);
    }

    public function getAlertClasses(array $values): string
    {
        return Arr::toCssClasses([
            'w-full flex flex-col p-4 dark:border',
            $values['backgroundColor'],
            $values['borderColor'],
            $this->rounded,
            $this->shadow,
        ]);
    }

    public function getHeaderClasses(array $values, HtmlString $slot): string
    {
        $border = Arr::toCssClasses(['border-b-2', $values['borderColor']]);

        return Arr::toCssClasses([
            $border => !$this->undivided && $slot->isNotEmpty(),
            'pb-3'  => $slot->isNotEmpty(),
            'flex items-center',
        ]);
    }

    public function getTitleClasses(array $values): string
    {
        return Arr::toCssClasses([
            'font-semibold text-sm whitespace-normal',
            $values['textColor'],
        ]);
    }

    public function getIconClasses(array $values): string
    {
        return Arr::toCssClasses([
            'w-5 h-5 mr-3 shrink-0',
            $values['iconColor'],
        ]);
    }

    public function getMainClasses(array $values): string
    {
        return Arr::toCssClasses([
            $values['textColor'],
            'rounded-b-xl grow ml-5',
            $this->padding,
        ]);
    }

    public function getFooterClasses(array $values): string
    {
        $border = Arr::toCssClasses(['border-t-2', $values['borderColor']]);

        return Arr::toCssClasses([
            'mt-2 pt-2 rounded-t-none',
            $border => !$this->undivided,
            $this->rounded,
        ]);
    }

    public function render(): Closure
    {
        return function (array $data) {
            return view('wireui::components.alert', $this->setupData($data))->render();
        };
    }
}
