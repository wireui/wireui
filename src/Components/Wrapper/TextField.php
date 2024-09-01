<?php

namespace WireUi\Components\Wrapper;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupForm;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\InteractsWithErrors;
use WireUi\View\WireUiComponent;

class TextField extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupForm;
    use HasSetupRounded;
    use InteractsWithErrors;

    protected array $packs = ['shadow'];

    protected array $props = [
        'icon' => null,
        'error' => null,
        'label' => null,
        'corner' => null,
        'prefix' => null,
        'suffix' => null,
        'padding' => null,
        'errorless' => false,
        'right-icon' => null,
        'shadowless' => false,
        'description' => null,
        'invalidated' => null,
        'with-error-icon' => true,
        'with-validation-colors' => true,
    ];

    public function __construct(string $config)
    {
        $this->config = $config;
    }

    protected function processed(): void
    {
        if (filled($this->name) && is_null($this->invalidated)) {
            $this->invalidated = $this->errors()->has($this->name);
        }
    }

    protected function blade(): View
    {
        return view('wireui-wrapper::text-field');
    }
}
