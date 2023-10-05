<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupSize, HasSetupUnderline};
use WireUi\WireUi\Link\{Color, Size, Underline};

class Link extends WireUiComponent
{
    use HasSetupButton;
    use HasSetupColor;
    use HasSetupSize;
    use HasSetupUnderline;

    public function __construct(
        public ?string $label = null,
    ) {
        $this->setSizeResolve(Size::class);
        $this->setColorResolve(Color::class);
        $this->setUnderlineResolve(Underline::class);
    }

    public function blade(): View
    {
        return view('wireui::components.link');
    }
}
