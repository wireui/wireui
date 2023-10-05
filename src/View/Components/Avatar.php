<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupBorder, HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize};
use WireUi\WireUi\Avatar\{Border, Color, IconSize, Size};
use WireUi\WireUi\Rounded;

class Avatar extends WireUiComponent
{
    use HasSetupBorder;
    use HasSetupColor;
    use HasSetupIcon;
    use HasSetupIconSize;
    use HasSetupRounded;
    use HasSetupSize;

    public function __construct(
        public ?string $src = null,
        public ?string $label = null,
    ) {
        $this->setSizeResolve(Size::class);
        $this->setColorResolve(Color::class);
        $this->setBorderResolve(Border::class);
        $this->setRoundedResolve(Rounded::class);
        $this->setIconSizeResolve(IconSize::class);
    }

    public function blade(): View
    {
        return view('wireui::components.avatar');
    }
}
