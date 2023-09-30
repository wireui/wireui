<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupPadding, HasSetupRounded, HasSetupShadow};
use WireUi\WireUi\Card\{Colors, Paddings, Rounders, Shadows};

class Card extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupPadding;
    use HasSetupRounded;
    use HasSetupShadow;

    public function __construct(
        public ?string $title = null,
        public ?bool $borderless = null,
    ) {
        $this->setColorResolve(Colors::class);
        $this->setShadowResolve(Shadows::class);
        $this->setPaddingResolve(Paddings::class);
        $this->setRoundedResolve(Rounders::class);

        $this->borderless ??= config('wireui.card.borderless', false);
    }

    public function blade(): View
    {
        return view('wireui::components.card');
    }
}
