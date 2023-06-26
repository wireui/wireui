<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupModal;
use WireUi\Traits\Customization\{HasSetupAlign, HasSetupBlur, HasSetupMaxWidth, HasSetupType};
use WireUi\WireUi\Modal\{Aligns, Blurs, MaxWidths, Types};

class Modal extends BaseComponent
{
    use HasSetupBlur;
    use HasSetupType;
    use HasSetupAlign;
    use HasSetupModal;
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
            $this->spacing ?? data_get($this->typeClasses, 'spacing', 'p-4'),
            $this->zIndex  ?? data_get($this->typeClasses, 'z-index', 'z-50'),
            'fixed inset-0 overflow-y-auto',
        ]);
    }

    public function getBackdropClasses(): string
    {
        return Arr::toCssClasses([
            'fixed inset-0 bg-secondary-400 dark:bg-secondary-700 bg-opacity-60',
            'dark:bg-opacity-60 transform transition-opacity',
            $this->blurClasses => !$this->blurless,
        ]);
    }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            'w-full min-h-full transform flex items-end justify-center mx-auto',
            $this->maxWidthClasses,
            $this->alignClasses,
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.modal';
    }
}
