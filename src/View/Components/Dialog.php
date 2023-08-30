<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Actions\Dialog as DialogAction;
use WireUi\Traits\Components\{HasSetupAlign, HasSetupBlur, HasSetupMaxWidth, HasSetupType};
use WireUi\WireUi\Modal\{Aligns, Blurs, MaxWidths, Types};

class Dialog extends BaseComponent
{
    use HasSetupAlign;
    use HasSetupBlur;
    use HasSetupMaxWidth;
    use HasSetupType;

    public string $dialog;

    public function __construct(
        string $id = null,
        public ?string $title = null,
        public ?string $zIndex = null,
        public ?string $spacing = null,
        public ?string $description = null,
    ) {
        $this->setBlurResolve(Blurs::class);
        $this->setTypeResolve(Types::class);
        $this->setAlignResolve(Aligns::class);
        $this->setMaxWidthResolve(MaxWidths::class);

        $this->dialog = DialogAction::makeEventName($id);
        $this->zIndex  ??= config('wireui.modal.z-index');
        $this->spacing ??= config('wireui.modal.spacing');
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
