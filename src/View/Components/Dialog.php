<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupDialog, HasSetupModal};
use WireUi\Traits\Customization\{HasSetupAlign, HasSetupBlur, HasSetupMaxWidth, HasSetupType};
use WireUi\WireUi\Modal\{Aligns, Blurs, MaxWidths, Types};

class Dialog extends BaseComponent
{
    use HasSetupBlur;
    use HasSetupType;
    use HasSetupAlign;
    use HasSetupModal;
    use HasSetupDialog;
    use HasSetupMaxWidth;

    public function __construct()
    {
        $this->setBlurResolve(Blurs::class);
        $this->setTypeResolve(Types::class);
        $this->setAlignResolve(Aligns::class);
        $this->setMaxWidthResolve(MaxWidths::class);
    }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            'soft-scrollbar' => data_get($this->typeClasses, 'soft-scrollbar', false),
            'hide-scrollbar' => data_get($this->typeClasses, 'hide-scrollbar', false),
            $this->zIndex ?? data_get($this->typeClasses, 'z-index', 'z-50'),
            'fixed inset-0 flex overflow-y-auto sm:pt-16 justify-center',
            $this->alignClasses,
        ]);
    }

    public function getBackdropClasses(): string
    {
        return Arr::toCssClasses([
            'fixed inset-0 bg-secondary-400 bg-opacity-60 transform transition-opacity',
            'dark:bg-secondary-700 dark:bg-opacity-60',
            $this->blurClasses => !$this->blurless,
            "{$this->dialog}-backdrop",
        ]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            $this->spacing ?? data_get($this->typeClasses, 'spacing', 'p-4'),
            'w-full transition-all',
            $this->maxWidthClasses,
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.dialog';
    }
}
