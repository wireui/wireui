<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupCheckbox;
use WireUi\Traits\Customization\HasSetupColor;
use WireUi\Traits\Customization\HasSetupForm;
use WireUi\Traits\Customization\HasSetupRounded;
use WireUi\Traits\Customization\HasSetupSize;
use WireUi\WireUi\Checkbox\Colors;
use WireUi\WireUi\Checkbox\Rounders;
use WireUi\WireUi\Checkbox\Sizes;

class Checkbox extends BaseComponent
{
    use HasSetupForm;
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

    public function getClasses(bool $hasError): string
    {
        $default = 'cursor-pointer form-checkbox transition ease-in-out duration-100';

        // dd($this->color, $this->colorClasses);

        // $size    = "size: {$this->size}";
        // $color   = "color: {$this->color}";
        // $rounded = "rounded: {$this->rounded}";

        // return "{$size} {$color} {$rounded}";

        // $withError = <<<EOT
        //     focus:ring-negative-500 ring-negative-500 border-negative-400 text-negative-600
        //     focus:border-negative-400 dark:focus:border-negative-600 dark:ring-negative-600
        //     dark:border-negative-600 dark:bg-negative-700 dark:checked:bg-negative-700
        //     dark:focus:ring-offset-secondary-800 dark:checked:border-negative-700
        // EOT;

        // $withoutError = <<<EOT
        //     border-secondary-300 text-primary-600 focus:ring-primary-600 focus:border-primary-400
        //     dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600
        //     dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600
        //     dark:focus:ring-offset-secondary-800
        // EOT;

        // return Arr::toCssClasses([
        //     $this->roundedClasses,
        //     $this->colorClasses,
        //     $this->sizeClasses,
        //     $default,
        //     // $withError    => $hasError,
        //     // $withoutError => !$hasError,
        // ]);

        return Arr::toCssClasses([
            $this->roundedClasses,
            $this->colorClasses,
            $this->sizeClasses,
            $default,
        ]);
    }

    protected function getView(): string
    {
        return 'wireui::components.checkbox';
    }
}
