<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupSize};
use WireUi\WireUi\Radio\{Colors, Rounders, Sizes};

class Radio extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use IsFormComponent;

    public function __construct(
        public ?string $label = null,
        public ?string $leftLabel = null,
        public ?string $description = null,
    ) {
        $this->setSizeResolve(Sizes::class);
        $this->setColorResolve(Colors::class);
        $this->setRoundedResolve(Rounders::class);
    }

    public function getClasses(bool $hasError): string
    {
        $default = 'form-radio transition ease-in-out duration-100';

        // $default = "form-radio rounded-full transition ease-in-out duration-100 {$this->size()}";

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
        //     $default,
        //     $withError    => $hasError,
        //     $withoutError => !$hasError,
        // ]);

        return Arr::toCssClasses([
            $this->roundedClasses,
            $this->colorClasses,
            $this->sizeClasses,
            $default,
        ]);
    }

    protected function blade(): View
    {
        return view('wireui::components.radio');
    }
}
