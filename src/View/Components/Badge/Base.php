<?php

namespace WireUi\View\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;
use WireUi\WireUi\Badge\Sizes\Base as BaseSize;
use WireUi\WireUi\Badge\{IconSizes, Rounders, Variants};

class Base extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupIcon;
    use HasSetupIconSize;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupVariant;

    public function __construct(
        public bool $full = false,
        public ?string $label = null,
    ) {
        $this->setSizeResolve(BaseSize::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setVariantResolve(Variants::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    public function blade(): View
    {
        return view('wireui::components.badge.base');
    }
}
