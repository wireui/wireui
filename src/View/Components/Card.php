<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupCard;
use WireUi\Traits\Customization\{HasSetupColor, HasSetupPadding, HasSetupRounded, HasSetupShadow};
use WireUi\WireUi\Cards\{Colors, Paddings, Rounders, Shadows};

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
            $this->shadowClasses => !$this->shadowless,
            $this->colorClasses['root'],
            $this->roundedClasses,
        ]);
    }

    public function getHeaderClasses(): string
    {
        $border = Arr::toCssClasses([
            $this->colorClasses['border'],
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
            'font-medium text-base whitespace-normal',
            $this->colorClasses['text'],
        ]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            $this->colorClasses['text'],
            $this->paddingClasses,
            'grow',
        ]);
    }

    public function getFooterClasses(): string
    {
        $border = Arr::toCssClasses([
            $this->colorClasses['border'],
            'border-t',
        ]);

        return Arr::toCssClasses([
            $this->colorClasses['footer'],
            $border => !$this->borderless,
            'px-4 py-4 sm:px-6',
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.card';
    }
}
