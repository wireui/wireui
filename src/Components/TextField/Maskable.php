<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Attributes\Process;
use WireUi\Exceptions\WireUiMaskableException;
use WireUi\Traits\Components\InteractsWithWrapper;
use WireUi\View\WireUiComponent;

class Maskable extends WireUiComponent
{
    use InteractsWithWrapper;

    protected array $props = [
        'mask' => null,
        'emit-formatted' => false,
    ];

    #[Process()]
    protected function process(): void
    {
        $this->mask ??= $this->getInputMask();
    }

    protected function getInputMask(): array|string
    {
        throw new WireUiMaskableException($this);
    }

    protected function blade(): View
    {
        return view('wireui-text-field::maskable');
    }
}
