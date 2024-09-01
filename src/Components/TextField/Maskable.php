<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Exceptions\WireUiMaskableException;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\WireUiComponent;

class Maskable extends WireUiComponent
{
    use HasSetupWrapper;

    protected array $props = [
        'mask' => null,
        'emit-formatted' => false,
    ];

    protected function processed(): void
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
