<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupColor, HasSetupPadding, HasSetupRounded, HasSetupShadow};
use WireUi\WireUi\Card\{Colors, Paddings, Rounders, Shadows};

class Card extends BaseComponent
{
    use HasSetupColor;
    use HasSetupShadow;
    use HasSetupPadding;
    use HasSetupRounded;

    public function __construct(
        public ?string $title = null,
        public ?bool $borderless = null,
    ) {
        $this->setColorResolve(Colors::class);
        $this->setShadowResolve(Shadows::class);
        $this->setPaddingResolve(Paddings::class);
        $this->setRoundedResolve(Rounders::class);

        $this->borderless ??= config('wireui.card.borderless', false);
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'root', 'bg-white dark:bg-secondary-800'),
            $this->shadowClasses => !$this->shadowless,
            $this->roundedClasses,
        ]);
    }

    public function getHeaderClasses(): string
    {
        $border = Arr::toCssClasses([
            data_get($this->colorClasses, 'border', 'border-secondary-200 dark:border-secondary-600'),
            'border-b',
        ]);

        return Arr::toCssClasses([
            'px-4 py-2.5 flex justify-between items-center',
            $border => !$this->borderless,
        ]);
    }

    public function getTitleClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'text', 'text-secondary-700 dark:text-secondary-400'),
            'font-medium text-base whitespace-normal',
        ]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'text', 'text-secondary-700 dark:text-secondary-400'),
            $this->paddingClasses,
            'grow',
        ]);
    }

    public function getFooterClasses(): string
    {
        $border = Arr::toCssClasses([
            data_get($this->colorClasses, 'border', 'border-secondary-200 dark:border-secondary-600'),
            'border-t',
        ]);

        return Arr::toCssClasses([
            data_get($this->colorClasses, 'footer', 'bg-secondary-50 dark:bg-secondary-800'),
            'px-4 py-4 sm:px-6 bg-clip-content',
            $border => !$this->borderless,
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.card';
    }
}
