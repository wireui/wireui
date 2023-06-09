<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use WireUi\Actions;
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

    // public string $dialog;

    // public function __construct(
    //     ?string $zIndex = null,
    //     ?string $maxWidth = null,
    //     ?string $spacing = null,
    //     ?string $align = null,
    //     ?string $id = null,
    //     ?string $blur = null,

    //     public ?string $title = null,
    //     public ?string $description = null,
    // ) {
    //     parent::__construct(
    //         name: '',
    //         zIndex: $zIndex,
    //         maxWidth: $maxWidth,
    //         spacing: $spacing,
    //         align: $align,
    //         blur: $blur,
    //     );

    //     $this->dialog = Actions\Dialog::makeEventName($id);
    // }

    // public function render(): View
    // {
    //     return view('wireui::components.dialog');
    // }

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            'soft-scrollbar' => $this->typeClasses['soft-scrollbar'] ?? false,
            'hide-scrollbar' => $this->typeClasses['hide-scrollbar'] ?? false,
            $this->spacing                                           ?? $this->typeClasses['spacing'],
            $this->zIndex                                            ?? $this->typeClasses['z-index'],
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
        return 'wireui::components.dialog';
    }
}
