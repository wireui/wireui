<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupAvatar;
use WireUi\Traits\Customization\HasSetupBorder;
use WireUi\Traits\Customization\HasSetupColor;
use WireUi\Traits\Customization\HasSetupIcon;
use WireUi\Traits\Customization\HasSetupIconSize;
use WireUi\Traits\Customization\HasSetupRounded;
use WireUi\Traits\Customization\HasSetupSize;
use WireUi\WireUi\Avatar\Borders;
use WireUi\WireUi\Avatar\Colors;
use WireUi\WireUi\Avatar\IconSizes;
use WireUi\WireUi\Avatar\Rounders;
use WireUi\WireUi\Avatar\Sizes;

class Avatar extends BaseComponent
{
    use HasSetupSize;
    use HasSetupIcon;
    use HasSetupColor;
    use HasSetupAvatar;
    use HasSetupBorder;
    use HasSetupRounded;
    use HasSetupIconSize;

    public function __construct()
    {
        $this->setSizeResolve(Sizes::class);
        $this->setColorResolve(Colors::class);
        $this->setBorderResolve(Borders::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'border', 'border-secondary-200 dark:border-secondary-500') => ! $this->borderless,
            data_get($this->colorClasses, 'label', 'bg-secondary-500 dark:bg-secondary-600') => ! $this->src,
            'shrink-0 inline-flex items-center justify-center overflow-hidden',
            $this->borderClasses => ! $this->borderless,
            $this->sizeClasses => ! $this->src,
            $this->roundedClasses,
            $this->sizeClasses,
        ]);
    }

    public function getLabelClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->iconSizeClasses, 'label', 'text-base'),
            'font-medium text-white dark:text-gray-200',
        ]);
    }

    public function getImageClasses(): string
    {
        return Arr::toCssClasses([
            'shrink-0 object-cover object-center',
            $this->roundedClasses,
            $this->sizeClasses,
        ]);
    }

    public function getIconClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->iconSizeClasses, 'icon', 'w-7 h-7'),
            'text-white dark:text-gray-200 shrink-0',
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.avatar';
    }
}
