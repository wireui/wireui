<?php

namespace WireUi\View\Components\Button;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupButton;
use WireUi\Traits\Customization\HasSetupColor;
use WireUi\Traits\Customization\HasSetupIcon;
use WireUi\Traits\Customization\HasSetupIconSize;
use WireUi\Traits\Customization\HasSetupRounded;
use WireUi\Traits\Customization\HasSetupSize;
use WireUi\Traits\Customization\HasSetupSpinner;
use WireUi\Traits\Customization\HasSetupStateColor;
use WireUi\Traits\Customization\HasSetupVariant;
use WireUi\View\Components\BaseComponent;
use WireUi\WireUi\Button\IconSizes;
use WireUi\WireUi\Button\Rounders;
use WireUi\WireUi\Button\Sizes\Base as SizesBase;
use WireUi\WireUi\Button\Variants;

class Base extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupSize;
    use HasSetupColor;
    use HasSetupButton;
    use HasSetupRounded;
    use HasSetupSpinner;
    use HasSetupVariant;
    use HasSetupIconSize;
    use HasSetupStateColor;

    public function __construct()
    {
        $this->setSizeResolve(SizesBase::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setVariantResolve(Variants::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    private function getDefaultClasses(): string
    {
        return Arr::toCssClasses([
            'outline-none inline-flex justify-center items-center group hover:shadow-sm',
            'transition-all ease-in-out duration-200 focus:ring-2 focus:ring-offset-2',
            'focus:ring-offset-background-white dark:focus:ring-offset-background-dark',
            'disabled:opacity-80 disabled:cursor-not-allowed',
        ]);
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'base', ''),
            data_get($this->colorClasses, 'hover', ''),
            data_get($this->colorClasses, 'focus', ''),
            $this->getDefaultClasses(),
            'w-full' => $this->full,
            $this->roundedClasses,
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
        return 'wireui::components.button.base';
    }
}
