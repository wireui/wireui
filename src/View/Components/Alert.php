<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIcon, HasSetupPadding, HasSetupRounded, HasSetupShadow, HasSetupVariant};
use WireUi\WireUi\Alert\{Padding, Variant};
use WireUi\WireUi\{Rounded, Shadow};

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
        $this->setShadowResolve(Shadow::class);
        $this->setPaddingResolve(Padding::class);
        $this->setRoundedResolve(Rounded::class);
        $this->setVariantResolve(Variant::class);
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
