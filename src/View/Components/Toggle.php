<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupSize};

class Toggle extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use IsFormComponent;

    protected array $props = [
        'icon'        => null,
        'label'       => null,
        'iconless'    => false,
        'left-label'  => null,
        'right-icon'  => null,
        'description' => null,
    ];

    public function backgroundClasses(bool $hasError): string
    {
        $default = Arr::toCssClasses([
            'block rounded-full cursor-pointer transition ease-in-out duration-100',
            'peer-focus:ring-2 peer-focus:ring-offset-2',
            'group-focus:ring-2 group-focus:ring-offset-2',
        ]);

        return Arr::toCssClasses([
            data_get($this->sizeClasses, 'background', ''),
            $this->colorClasses,
            $default,
        ]);
    }

    public function circleClasses(): string
    {
        $default = Arr::toCssClasses([
            'translate-x-0 transform transition ease-in-out duration-200 cursor-pointer shadow',
            'checked:bg-none peer focus:ring-0 focus:ring-offset-0 focus:outline-none bg-white',
            'absolute mx-0.5 my-auto inset-y-0 rounded-full border-0 appearance-none',
            'checked:text-white dark:bg-secondary-200',
        ]);

        return Arr::toCssClasses([
            data_get($this->sizeClasses, 'circle', ''),
            $default,
        ]);
    }

    protected function blade(): View
    {
        return view('wireui::components.toggle');
    }
}
