<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupBorder, HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize};
use WireUi\WireUi\Avatar\{Borders, Colors, IconSizes, Rounders, Sizes};

class Avatar extends BaseComponent
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
        $this->setSizeResolve(Sizes::class);
        $this->setColorResolve(Colors::class);
        $this->setBorderResolve(Borders::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    public function blade(): View
    {
        return view('wireui::components.avatar');
    }
}
