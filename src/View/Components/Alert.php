<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIcon, HasSetupPadding, HasSetupRounded, HasSetupShadow, HasSetupVariant};
use WireUi\WireUi\Alert\{Paddings, Rounders, Shadows, Variants};

class Alert extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupColor;
    use HasSetupShadow;
    use HasSetupPadding;
    use HasSetupRounded;
    use HasSetupVariant;

    public function __construct(
        public ?string $title = null,
    ) {
        $this->setShadowResolve(Shadows::class);
        $this->setPaddingResolve(Paddings::class);
        $this->setRoundedResolve(Rounders::class);
        $this->setVariantResolve(Variants::class);
    }

    public function getUseIcon(): mixed
    {
        return $this->icon ?? data_get($this->colorClasses, 'icon', 'bell');
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'backgroundColor', 'bg-primary-50 dark:bg-primary-900/70'),
            data_get($this->colorClasses, 'borderColor', ''),
            $this->shadowClasses => !$this->shadowless,
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

    public function getTitleClasses(mixed $slot): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'textColor', 'text-primary-800 dark:text-primary-200'),
            'font-semibold' => $slot->isNotEmpty(),
            'font-normal'   => $slot->isEmpty(),
            'text-sm whitespace-normal',
        ]);
    }

    public function getIconClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'iconColor', 'text-primary-800 dark:text-primary-200'),
            'w-5 h-5 mr-3 shrink-0',
        ]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'textColor', 'text-primary-800 dark:text-primary-200'),
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
