<?php

namespace WireUi\View\Components\Inputs;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use WireUi\Traits\Components\IsFormComponent;

abstract class BaseMaskable extends Component
{
    use IsFormComponent;

    public string $mask;

    public function __construct(
        public bool $emitFormatted = false,
        string $mask = null,
    ) {
        $this->mask = $this->formatMask($mask ?: $this->getInputMask());
    }

    protected function blade(): View
    {
        return view('wireui::components.inputs.maskable');
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
