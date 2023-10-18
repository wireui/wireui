<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupPadding, HasSetupRounded, HasSetupShadow};

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
        $this->borderless ??= config('wireui.card.borderless', false);
    }

    public function blade(): View
    {
        return view('wireui::components.card');
    }
}
