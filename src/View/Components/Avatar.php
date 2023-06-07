<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupAvatar;
use WireUi\Traits\Customization\{HasSetupBorder, HasSetupColor, HasSetupIcon, HasSetupRounded, HasSetupSize};
use WireUi\WireUi\Avatar\{Borders, Colors, IconSizes, Rounders, Sizes};

class Avatar extends BaseComponent
{
    use HasSetupSize;
    use HasSetupIcon;
    use HasSetupColor;
    use HasSetupAvatar;
    use HasSetupBorder;
    use HasSetupRounded;

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
            'shrink-0 inline-flex items-center justify-center overflow-hidden',
            $this->colorClasses['label']  => !$this->src,
            $this->colorClasses['border'] => !$this->borderless,
            $this->borderClasses          => !$this->borderless,
            $this->sizeClasses            => !$this->src,
            $this->roundedClasses,
            $this->sizeClasses,
        ]);
    }

    public function getLabelClasses(): string
    {
        return Arr::toCssClasses([
            'font-medium text-white dark:text-gray-200',
            $this->iconClasses['label'],
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
            'text-white dark:text-gray-200 shrink-0',
            $this->iconClasses['icon'],
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.avatar';
    }
}
