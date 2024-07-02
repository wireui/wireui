<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Exceptions\WireUiMaskableException;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\View\WireUiComponent;

class Maskable extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'mask' => null,
        'shadowless' => false,
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
