<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupPadding, HasSetupRounded, HasSetupShadow};
use WireUi\WireUi\Card\{Color, Padding};
use WireUi\WireUi\{Rounded, Shadow};

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
        $this->setColorResolve(Color::class);
        $this->setShadowResolve(Shadow::class);
        $this->setPaddingResolve(Padding::class);
        $this->setRoundedResolve(Rounded::class);

        $this->borderless ??= config('wireui.card.borderless', false);
    }

    public function blade(): View
    {
        return view('wireui::components.card');
    }
}
