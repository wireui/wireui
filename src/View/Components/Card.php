<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupCard;
use WireUi\Traits\Customization\{HasSetupColor, HasSetupPadding, HasSetupRounded, HasSetupShadow};
use WireUi\WireUi\Card\{Colors, Paddings, Rounders, Shadows};

class Card extends BaseComponent
{
    use HasSetupCard;
    use HasSetupColor;
    use HasSetupShadow;
    use HasSetupPadding;
    use HasSetupRounded;

    protected function __construct()
    {
        $this->setColorResolve(Colors::class);
        $this->setShadowResolve(Shadows::class);
        $this->setPaddingResolve(Paddings::class);
        $this->setRoundedResolve(Rounders::class);
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'root', 'bg-white dark:bg-secondary-800'),
            $this->shadowClasses => !$this->shadowless,
            $this->roundedClasses,
            'overflow-hidden',
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
            $border => !$this->borderless,
            'px-4 py-4 sm:px-6',
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.card';
    }
}
