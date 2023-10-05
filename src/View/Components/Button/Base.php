<?php

namespace WireUi\View\Components\Button;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupSpinner, HasSetupStateColor, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;
use WireUi\WireUi\Button\Size\Base as BaseSize;
use WireUi\WireUi\Button\{IconSize, Variant};
use WireUi\WireUi\Rounded;

class Base extends WireUiComponent
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
        public bool $full = false,
        public bool $loading = true,
        public ?string $label = null,
    ) {
        $this->setSizeResolve(BaseSize::class);
        $this->setRoundedResolve(Rounded::class);
        $this->setVariantResolve(Variant::class);
        $this->setIconSizeResolve(IconSize::class);
    }

    public function blade(): View
    {
        return view('wireui::components.button.base');
    }
}
