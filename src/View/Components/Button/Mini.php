<?php

namespace WireUi\View\Components\Button;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupSpinner, HasSetupStateColor, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;
use WireUi\WireUi\Button\Size\Mini as MiniSize;
use WireUi\WireUi\Button\{IconSize, Variant};
use WireUi\WireUi\Rounded;

class Mini extends WireUiComponent
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
        $this->setSizeResolve(MiniSize::class);
        $this->setRoundedResolve(Rounded::class);
        $this->setVariantResolve(Variant::class);
        $this->setIconSizeResolve(IconSize::class);
    }

    public function blade(): View
    {
        return view('wireui::components.button.mini');
    }
}
