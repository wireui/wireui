<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupAlert;
use WireUi\Traits\Customization\{HasSetupColor, HasSetupIcon, HasSetupPadding, HasSetupRounded, HasSetupShadow, HasSetupVariant};
use WireUi\WireUi\Alert\{IconSizes, Paddings, Rounders, Shadows, Variants};

class Alert extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupAlert;
    use HasSetupColor;
    use HasSetupShadow;
    use HasSetupPadding;
    use HasSetupRounded;
    use HasSetupVariant;

    public function __construct()
    {
        $this->setShadowResolve(Shadows::class);
        $this->setPaddingResolve(Paddings::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setVariantResolve(Variants::class);
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
            'w-full flex flex-col p-4',
            $this->roundedClasses,
        ]);
    }

    public function getHeaderClasses(mixed $slot): string
    {
        return Arr::toCssClasses([
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
            'grow text-sm',
        ]);
    }

    public function getFooterClasses(): string
    {
        return Arr::toCssClasses(['mt-2 pt-2']);
    }

    public function getView(): string
    {
        return 'wireui::components.alert';
    }
}
