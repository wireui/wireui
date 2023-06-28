<?php

namespace WireUi\View\Components\Button;

use Illuminate\Support\Arr;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Traits\Components\HasSetupButton;
use WireUi\Traits\Customization\{HasSetupColor, HasSetupIcon, HasSetupRounded, HasSetupSize, HasSetupSpinner, HasSetupStateColor, HasSetupVariant};
use WireUi\View\Components\BaseComponent;
use WireUi\WireUi\Button\Sizes\Base as SizesBase;
use WireUi\WireUi\Button\{IconSizes, Rounders, Variants};

class Base extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupSize;
    use HasSetupColor;
    use HasSetupButton;
    use HasSetupRounded;
    use HasSetupSpinner;
    use HasSetupVariant;
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
        return <<<EOT
            outline-none inline-flex justify-center items-center group hover:shadow-sm
            transition-all ease-in-out duration-200 focus:ring-2 focus:ring-offset-2
            focus:ring-offset-background-white dark:focus:ring-offset-background-dark
            disabled:opacity-80 disabled:cursor-not-allowed
        EOT;
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            $this->colorClasses['base'],
            $this->colorClasses['hover'],
            $this->colorClasses['focus'],
            $this->getDefaultClasses(),
            'w-full' => $this->full,
            $this->roundedClasses,
            $this->sizeClasses,
        ]);
    }

    public function getRightIconAttributes(): ComponentAttributeBag
    {
        $attributes = new ComponentAttributeBag();

        $options = $this->spinnerRemove ? [$this->spinnerRemove => 'true'] : [];

        return $attributes->merge([
            ...$options,
            'name' => $this->rightIcon,
            'class' => $this->getIconClasses(),
        ]);
    }

    public function getIconClasses(): string
    {
        return Arr::toCssClasses([
            $this->iconClasses,
            'shrink-0',
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.button.base';
    }
}
