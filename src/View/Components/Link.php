<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupLink;
use WireUi\Traits\Customization\{HasSetupColor, HasSetupSize, HasSetupUnderline};
use WireUi\WireUi\Link\{Colors, Sizes, Underlines};

class Link extends BaseComponent
{
    use HasSetupLink;
    use HasSetupSize;
    use HasSetupColor;
    use HasSetupUnderline;

    public function __construct()
    {
        $this->setSizeResolve(Sizes::class);
        $this->setColorResolve(Colors::class);
        $this->setUnderlineResolve(Underlines::class);
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            'font-semibold text-center inline-block',
            $this->underlineClasses,
            $this->colorClasses,
            $this->sizeClasses,
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.link';
    }
}