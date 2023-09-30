<?php

namespace WireUi\View\Components\Input;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\Components\WireUiComponent;

abstract class Maskable extends WireUiComponent
{
    use HasSetupWrapper;

    public string $mask;

    public function __construct(
        public bool $emitFormatted = false,
        string $mask = null,
    ) {
        $this->mask = $this->formatMask($mask ?: $this->getInputMask());
    }

    protected function blade(): View
    {
        return view('wireui::components.input.maskable');
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
}
