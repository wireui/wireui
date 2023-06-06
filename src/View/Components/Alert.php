<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupAlert;
use WireUi\Traits\Customization\{HasSetupBorder, HasSetupColor, HasSetupIcon, HasSetupPadding, HasSetupRounded, HasSetupShadow};
use WireUi\WireUi\Alert\{Borders, Colors, IconSizes, Paddings, Rounders, Shadows};

class Alert extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupAlert;
    use HasSetupColor;
    use HasSetupBorder;
    use HasSetupShadow;
    use HasSetupPadding;
    use HasSetupRounded;

    public function __construct()
    {
        $this->setColorResolve(Colors::class);
        $this->setBorderResolve(Borders::class);
        $this->setShadowResolve(Shadows::class);
        $this->setPaddingResolve(Paddings::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    public function getUseIcon(): mixed
    {
        return $this->icon ?? $this->colorClasses['icon'];
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            $this->shadowClasses => !$this->shadowless,
            $this->colorClasses['backgroundColor'],
            $this->colorClasses['borderColor'],
            $this->borderClasses['root'],
            'w-full flex flex-col p-4',
            $this->roundedClasses,
        ]);
    }

    public function getHeaderClasses(mixed $slot): string
    {
        $border = Arr::toCssClasses([
            $this->colorClasses['borderColor'],
            $this->borderClasses['header'],
        ]);

        return Arr::toCssClasses([
            $border => !$this->borderless && $slot->isNotEmpty(),
            'flex justify-between items-center',
            'pb-3' => $slot->isNotEmpty(),
        ]);
    }

    public function getTitleClasses(): string
    {
        return Arr::toCssClasses([
            'font-semibold text-sm whitespace-normal',
            $this->colorClasses['textColor'],
        ]);
    }

    public function getIconClasses(): string
    {
        return Arr::toCssClasses([
            $this->colorClasses['iconColor'],
            $this->iconClasses,
        ]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            $this->colorClasses['textColor'],
            $this->paddingClasses,
            'grow ml-5 text-sm',
        ]);
    }

    public function getFooterClasses(): string
    {
        $border = Arr::toCssClasses([
            $this->colorClasses['borderColor'],
            $this->borderClasses['footer'],
        ]);

        return Arr::toCssClasses([
            $border => !$this->borderless,
            'mt-2 pt-2',
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.alert';
    }
}
