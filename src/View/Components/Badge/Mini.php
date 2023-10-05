<?php

namespace WireUi\View\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;
use WireUi\WireUi\Badge\Size\Mini as MiniSize;
use WireUi\WireUi\Badge\{IconSize, Variant};
use WireUi\WireUi\Rounded;

class Mini extends WireUiComponent
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
        $this->setRoundedResolve(Rounded::class);
        $this->setVariantResolve(Variant::class);
        $this->setIconSizeResolve(IconSize::class);
    }

    public function blade(): View
    {
        return view('wireui::components.badge.mini');
    }
}
