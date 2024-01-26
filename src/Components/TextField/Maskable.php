<?php

namespace WireUi\Components\TextField;

use Exception;
use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};
use WireUi\View\WireUiComponent;

class Maskable extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'mask'           => null,
        'shadowless'     => null,
        'emit-formatted' => false,
    ];

    protected function processed(): void
    {
        $this->mask ??= $this->getInputMask();
    }

    protected function getInputMask(): array|string
    {
        throw new Exception('Implement this method [getInputMask] on your component or pass [mask] in parameters');
    }

    protected function blade(): View
    {
        return view('wireui-text-field::maskable');
    }
}
