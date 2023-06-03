<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupModal;
use WireUi\Traits\Customization\{HasSetupAlign, HasSetupBlur, HasSetupMaxWidth};
use WireUi\WireUi\Modal\{Aligns, Blurs, MaxWidths};

class Modal extends BaseComponent
{
    use HasSetupBlur;
    use HasSetupAlign;
    use HasSetupModal;
    use HasSetupMaxWidth;

    public function __construct()
    {
        $this->setBlurResolve(Blurs::class);
        $this->setAlignResolve(Aligns::class);
        $this->setMaxWidthResolve(MaxWidths::class);
    }

    // public function __construct(
    //     public ?string $name = null,
    //     public ?string $zIndex = null,
    //     public ?string $maxWidth = null,
    //     public ?string $spacing = null,
    //     public ?string $align = null,
    //     public string|bool|null $blur = null,
    //     public bool $show = false,
    // ) {
    //     $zIndex   ??= config('wireui.modal.zIndex');
    //     $maxWidth ??= config('wireui.modal.maxWidth');
    //     $spacing  ??= config('wireui.modal.spacing');
    //     $align    ??= config('wireui.modal.align');
    //     $blur     ??= config('wireui.modal.blur');

    //     $this->zIndex   = $zIndex;
    //     $this->spacing  = $spacing;
    //     $this->maxWidth = $this->getMaxWidth($maxWidth);
    //     $this->align    = $this->getAlign($align);
    //     $this->blur     = $this->getBlur($blur);
    // }

    // private function getBlur($blur): ?string
    // {
    //     if (!$blur) {
    //         return null;
    //     }

    //     return match ($blur) {
    //         'sm'    => 'backdrop-blur-sm',
    //         'md'    => 'backdrop-blur-md',
    //         'lg'    => 'backdrop-blur-lg',
    //         'xl'    => 'backdrop-blur-xl',
    //         '2xl'   => 'backdrop-blur-2xl',
    //         '3xl'   => 'backdrop-blur-3xl',
    //         default => 'backdrop-blur',
    //     };
    // }

    // private function getMaxWidth(string $maxWidth): string
    // {
    //     return match ($maxWidth) {
    //         'sm'    => 'sm:max-w-sm',
    //         'md'    => 'sm:max-w-md',
    //         'lg'    => 'sm:max-w-lg',
    //         'xl'    => 'sm:max-w-xl',
    //         '2xl'   => 'sm:max-w-2xl',
    //         '3xl'   => 'sm:max-w-3xl',
    //         '4xl'   => 'sm:max-w-4xl',
    //         '5xl'   => 'sm:max-w-5xl',
    //         '6xl'   => 'sm:max-w-6xl',
    //         '7xl'   => 'sm:max-w-7xl',
    //         default => $maxWidth,
    //     };
    // }

    // public function getAlign(string $align): string
    // {
    //     return match ($align) {
    //         'start'  => 'sm:items-start',
    //         'center' => 'sm:items-center',
    //         'end'    => 'sm:items-end',
    //         default  => $align,
    //     };
    // }

    public function getMainClasses(): string
    {
        return Arr::toCssClasses([
            'fixed inset-0 overflow-y-auto',
            $this->spacing,
            $this->zIndex,
        ]);
    }

    public function getBackdropClasses(): string
    {
        return Arr::toCssClasses([
            'fixed inset-0 bg-secondary-400 dark:bg-secondary-700 bg-opacity-60',
            'dark:bg-opacity-60 transform transition-opacity',
            $this->blurClasses,
        ]);
    }

    public function getContainerClasses(): string
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
