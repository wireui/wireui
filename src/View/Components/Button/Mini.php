<?php

namespace WireUi\View\Components\Button;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupSpinner, HasSetupStateColor, HasSetupVariant};
use WireUi\View\Components\BaseComponent;
use WireUi\WireUi\Button\Sizes\Mini as SizesMini;
use WireUi\WireUi\Button\{IconSizes, Rounders, Variants};

class Mini extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupSize;
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSpinner;
    use HasSetupVariant;
    use HasSetupIconSize;
    use HasSetupStateColor;

    public ?string $tag = null;

    public function __construct(
        public bool $loading = true,
        public ?string $label = null,
    ) {
        $this->setSizeResolve(SizesMini::class);
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
        return 'wireui::components.button.mini';
    }

    /**
     * Setup to resolve the button type, tag and wire loading.
     */
    protected function setupButton(array &$component): void
    {
        $this->tag = $this->getTag();

        $this->ensureLinkType();

        $this->ensureWireLoading();

        $component['tag'] = $this->tag;

        $this->smart(['tag']);
    }

    private function getTag(): string
    {
        return $this->data->missing('href') ? 'button' : 'a';
    }

    private function ensureLinkType(): void
    {
        if (!$this->data->has('href') && !$this->data->has('type')) {
            $this->data->offsetSet('type', 'button');
        }
    }

    private function ensureWireLoading(): void
    {
        if ($this->loading) {
            $this->data->offsetSet('wire:loading.attr', 'disabled');
            $this->data->offsetSet('wire:loading.class', '!cursor-wait');
        }
    }
}
