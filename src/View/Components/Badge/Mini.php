<?php

namespace WireUi\View\Components\Badge;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupBadge;
use WireUi\Traits\Customization\HasSetupColor;
use WireUi\Traits\Customization\HasSetupIcon;
use WireUi\Traits\Customization\HasSetupIconSize;
use WireUi\Traits\Customization\HasSetupRounded;
use WireUi\Traits\Customization\HasSetupSize;
use WireUi\Traits\Customization\HasSetupVariant;
use WireUi\View\Components\BaseComponent;
use WireUi\WireUi\Badge\IconSizes;
use WireUi\WireUi\Badge\Rounders;
use WireUi\WireUi\Badge\Sizes\Mini as MiniSize;
use WireUi\WireUi\Badge\Variants;

class Mini extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupSize;
    use HasSetupBadge;
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupVariant;
    use HasSetupIconSize;

    public function __construct()
    {
        $this->setSizeResolve(MiniSize::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setVariantResolve(Variants::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            'outline-none inline-flex justify-center items-center group',
            $this->roundedClasses,
            $this->colorClasses,
            $this->sizeClasses,
        ]);
    }

    public function getIconClasses(): string
    {
        return Arr::toCssClasses([
            $this->iconSizeClasses,
            'shrink-0',
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.badge.mini';
    }
}
