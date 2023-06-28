<?php

namespace WireUi\View\Components\Badge;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupBadge;
use WireUi\Traits\Customization\{HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupVariant};
use WireUi\View\Components\BaseComponent;
use WireUi\WireUi\Badge\Sizes\Base as BaseSize;
use WireUi\WireUi\Badge\{IconSizes, Rounders, Variants};

class Base extends BaseComponent
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
        $this->setSizeResolve(BaseSize::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setVariantResolve(Variants::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            'outline-none inline-flex justify-center items-center group',
            'w-full' => $this->full,
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
        return 'wireui::components.badge.base';
    }
}
