<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupCheckbox;
use WireUi\Traits\Customization\HasSetupColor;
use WireUi\Traits\Customization\HasSetupIcon;
use WireUi\Traits\Customization\HasSetupRounded;
use WireUi\Traits\Customization\HasSetupSize;
use WireUi\WireUi\Toggle\Colors;
use WireUi\WireUi\Toggle\Rounders;
use WireUi\WireUi\Toggle\Sizes;

class Toggle extends BaseComponent
{
    use HasSetupIcon;
    use HasSetupSize;
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupCheckbox;

    public function __construct()
    {
        $this->setSizeResolve(Sizes::class);
        $this->setColorResolve(Colors::class);
        $this->setRoundedResolve(Rounders::class);
    }

    // public function backgroundClasses(bool $hasError): string
    // {
    //     $size = match ($this->size) {
    //         'sm' => 'h-4 w-7',
    //         'md' => 'h-5 w-9',
    //         'lg' => 'h-6 w-10',
    //     };

    //     $default = <<<EOT
    //         block rounded-full cursor-pointer transition ease-in-out duration-100
    //         peer-focus:ring-2 peer-focus:ring-offset-2
    //         group-focus:ring-2 group-focus:ring-offset-2
    //     EOT;

    //     $withError = <<<EOT
    //         bg-negative-600 peer-focus:ring-negative-600 dark:bg-negative-700
    //         group-focus:ring-negative-600 dark:group-focus:ring-negative-700
    //         dark:peer-focus:ring-negative-700 dark:peer-focus:ring-offset-secondary-800
    //     EOT;

    //     $withoutError = <<<EOT
    //         bg-secondary-200 peer-checked:bg-primary-600 peer-focus:ring-primary-600
    //         group-focus:ring-primary-600 dark:group-focus:ring-secondary-600
    //         dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800
    //         dark:bg-secondary-600 dark:peer-checked:bg-secondary-700
    //     EOT;

    //     return Arr::toCssClasses([
    //         $size,
    //         $default,
    //         $withError    => $hasError,
    //         $withoutError => !$hasError,
    //     ]);
    // }

    // public function circleClasses(): string
    // {
    //     $classes = <<<EOT
    //         absolute mx-0.5 my-auto inset-y-0 rounded-full border-0 appearance-none
    //         translate-x-0 transform transition ease-in-out duration-200 cursor-pointer shadow
    //         checked:bg-none peer focus:ring-0 focus:ring-offset-0 focus:outline-none bg-white
    //         checked:text-white dark:bg-secondary-200
    //     EOT;

    //     $size = match ($this->size) {
    //         'sm' => 'checked:translate-x-3 w-3 h-3',
    //         'md' => 'checked:translate-x-3.5 left-0.5 w-3.5 h-3.5',
    //         'lg' => 'checked:translate-x-4 left-0.5 w-4 h-4',
    //     };

    //     return Arr::toCssClasses([$size, $classes]);
    // }

    protected function getView(): string
    {
        return 'wireui::components.toggle';
    }
}
