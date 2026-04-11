<?php

namespace WireUi\Components\Select;

use Illuminate\Contracts\View\View;
use WireUi\Attributes\Process;
use WireUi\Components\Select\Traits\CheckOptions;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithRounded;
use WireUi\Traits\Components\InteractsWithWrapper;
use WireUi\View\WireUiComponent;

class Native extends WireUiComponent
{
    use CheckOptions;
    use InteractsWithColor;
    use InteractsWithRounded;
    use InteractsWithWrapper;

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

    #[Process()]
    protected function process(): void
    {
        $this->serializeOptions();

        $this->validateConfig();
    }

    protected function blade(): View
    {
        return view('wireui-select::native');
    }
}
