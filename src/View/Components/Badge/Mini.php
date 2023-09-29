<?php

namespace WireUi\View\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupVariant};
use WireUi\View\Components\BaseComponent;
use WireUi\WireUi\Badge\Sizes\Mini as MiniSize;
use WireUi\WireUi\Badge\{IconSizes, Rounders, Variants};

class Mini extends BaseComponent
{
    use HasSetupColor;
    use HasSetupIcon;
    use HasSetupIconSize;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupVariant;

    public function __construct(
        public ?string $label = null,
    ) {
        $this->setSizeResolve(MiniSize::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setVariantResolve(Variants::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    public function blade(): View
    {
        return view('wireui::components.badge.mini');
    }
}
