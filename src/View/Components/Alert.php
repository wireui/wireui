<?php

namespace WireUi\View\Components;

use Illuminate\Support\{Arr, HtmlString};
use WireUi\Traits\Components\HasSetupAlert;
use WireUi\Traits\Customization\{HasSetupBorder, HasSetupColor, HasSetupIcon, HasSetupRounded, HasSetupShadow, HasSetupType};
use WireUi\WireUi\Alert\{Borders, Colors, IconSizes, Rounders, Shadows, Types};

class Alert extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupType;
    use HasSetupAlert;
    use HasSetupColor;
    use HasSetupBorder;
    use HasSetupShadow;
    use HasSetupRounded;

    public function __construct()
    {
        $this->setTypeResolve(Types::class);
        $this->setColorResolve(Colors::class);
        $this->setBorderResolve(Borders::class);
        $this->setShadowResolve(Shadows::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setIconSizeResolve(IconSizes::class);
    }

    public function getAlertClasses(): string
    {
        return Arr::toCssClasses([
            $this->shadowClasses => !$this->shadowless,
            'w-full flex flex-col p-4 dark:border',
            $this->colorClasses['backgroundColor'],
            $this->colorClasses['borderColor'],
            $this->roundedClasses,
        ]);
    }

    public function getHeaderClasses(HtmlString $slot): string
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
            'rounded-b-xl grow ml-5 text-sm',
            $this->typeClasses,
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
            'mt-2 pt-2 rounded-t-none',
            $this->roundedClasses,
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.alert';
    }
}
