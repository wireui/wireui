<?php

namespace WireUi\View\Components\Input;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};
use WireUi\View\Components\WireUiComponent;

abstract class Maskable extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = ['mask', 'shadowless', 'emit-formatted' => false];

    protected function processed(): void
    {
        $this->mask = $this->formatMask($this->mask ?: $this->getInputMask());
    }

    private function formatMask(string $mask): string
    {
        if (Str::startsWith($mask, '[')) {
            return $mask;
        }

        return "'{$mask}'";
    }

    protected function getInputMask(): string
    {
        throw new Exception('Implement this method [getInputMask] on your component or pass [mask] in parameters');
    }

    protected function blade(): View
    {
        return view('wireui::components.input.maskable');
    }
}
