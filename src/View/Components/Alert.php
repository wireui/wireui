<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIcon, HasSetupPadding, HasSetupRounded, HasSetupShadow, HasSetupVariant};
use WireUi\WireUi\Alert\{Paddings, Rounders, Shadows, Variants};

class Alert extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupIcon;
    use HasSetupPadding;
    use HasSetupRounded;
    use HasSetupShadow;
    use HasSetupVariant;

    public function __construct(
        public ?string $title = null,
    ) {
        $this->setShadowResolve(Shadows::class);
        $this->setPaddingResolve(Paddings::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setVariantResolve(Variants::class);
    }

    public function getUseIcon(): mixed
    {
        return $this->icon ?? Arr::get($this->colorClasses, 'icon', 'bell');
    }

    public function blade(): View
    {
        return view('wireui::components.alert');
    }
}
