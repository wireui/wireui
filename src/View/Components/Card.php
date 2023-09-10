<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupColor, HasSetupPadding, HasSetupRounded, HasSetupShadow};
use WireUi\WireUi\Card\{Colors, Paddings, Rounders, Shadows};

class Card extends BaseComponent
{
    use HasSetupColor;
    use HasSetupPadding;
    use HasSetupRounded;
    use HasSetupShadow;

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
            data_get($this->colorClasses, 'root', ''),
            $this->shadowClasses => !$this->shadowless,
            $this->roundedClasses,
        ]);
    }

    public function getHeaderClasses(): string
    {
        $border = Arr::toCssClasses([
            data_get($this->colorClasses, 'border', ''),
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
            data_get($this->colorClasses, 'text', ''),
            'font-medium text-base whitespace-normal',
        ]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'text', ''),
            $this->paddingClasses,
            'grow',
        ]);
    }

    public function getFooterClasses(): string
    {
        $border = Arr::toCssClasses([
            data_get($this->colorClasses, 'border', ''),
            'border-t',
        ]);

        return Arr::toCssClasses([
            data_get($this->colorClasses, 'footer', ''),
            'px-4 py-4 sm:px-6 bg-clip-content',
            $border => !$this->borderless,
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.card';
    }
}
