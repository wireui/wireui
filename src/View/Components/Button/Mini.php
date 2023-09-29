<?php

namespace WireUi\View\Components\Button;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupSpinner, HasSetupStateColor, HasSetupVariant};
use WireUi\View\Components\BaseComponent;
use WireUi\WireUi\Button\Sizes\Mini as SizesMini;
use WireUi\WireUi\Button\{IconSizes, Rounders, Variants};

class Mini extends BaseComponent
{
    use HasSetupButton;
    use HasSetupColor;
    use HasSetupIcon;
    use HasSetupIconSize;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupSpinner;
    use HasSetupStateColor;
    use HasSetupVariant;

    public function __construct(
        public bool $loading = true,
        public ?string $label = null,
    ) {
        $this->setSizeResolve(SizesMini::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setVariantResolve(Variants::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    public function blade(): View
    {
        return view('wireui::components.button.mini');
    }
}
