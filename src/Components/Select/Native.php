<?php

namespace WireUi\Components\Select;

use Illuminate\Contracts\View\View;
use WireUi\Components\Select\Traits\CheckOptions;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\WireUiComponent;

class Native extends WireUiComponent
{
    use CheckOptions;
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupWrapper;

    protected array $props = [
        'options' => null,
        'placeholder' => null,
        'flip-options' => false,
        'option-value' => null,
        'option-label' => null,
        'empty-message' => null,
        'option-key-value' => false,
        'hide-empty-message' => false,
        'option-description' => null,
    ];

    protected function exclude(): array
    {
        return ['type', 'placeholder'];
    }

    protected function processed(): void
    {
        $this->serializeOptions();

        $this->validateConfig();
    }

    protected function blade(): View
    {
        return view('wireui-select::native');
    }
}
