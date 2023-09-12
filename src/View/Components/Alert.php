<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIcon, HasSetupPadding, HasSetupRounded, HasSetupShadow, HasSetupVariant};
use WireUi\WireUi\Alert\{Paddings, Rounders, Shadows, Variants};

class Alert extends BaseComponent
{
    use HasSetupColor;
    use HasSetupIcon;
    use HasSetupPadding;
    use HasSetupRounded;
    use HasSetupShadow;
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
            data_get($this->colorClasses, 'background', ''),
            data_get($this->colorClasses, 'border', ''),
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
            data_get($this->colorClasses, 'text', ''),
            'font-semibold' => $slot->isNotEmpty(),
            'font-normal'   => $slot->isEmpty(),
            'text-sm whitespace-normal',
        ]);
    }

    public function getIconClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'iconColor', ''),
            'w-5 h-5 mr-3 shrink-0',
        ]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            data_get($this->colorClasses, 'text', ''),
            $this->paddingClasses,
            'grow text-sm',
        ]);
    }

    public function getFooterClasses(): string
    {
        return Arr::toCssClasses(['mt-2 pt-2']);
    }

    public function blade(): View
    {
        return view('wireui::components.alert');
    }
}
