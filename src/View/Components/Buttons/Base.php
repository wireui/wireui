<?php

namespace WireUi\View\Components\Buttons;

use Closure;
use Illuminate\View\Component;
use WireUi\Traits\Buttons\HasSpinner;
use WireUi\Traits\HasModifiers;

abstract class Base extends Component
{
    use HasSpinner;
    use HasModifiers;

    public function __construct(
        public bool $disabledOnWireLoading = true,
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public ?string $iconSize = null,
    ) {
    }

    protected function ensureButtonType(): self
    {
        if (!$this->attributes->has('href') && !$this->attributes->has('type')) {
            $this->attributes->offsetSet('type', 'button');
        }

        return $this;
    }

    protected function ensureDisabledStateOnWireLoading(): self
    {
        if ($this->disabledOnWireLoading) {
            $this->attributes->offsetSet('wire:loading.attr', 'disabled');
            $this->attributes->offsetSet('wire:loading.class', '!cursor-wait');
        }

        return $this;
    }

    protected function tag(): string
    {
        if ($this->attributes->has('href')) {
            return 'a';
        }

        return 'button';
    }

    protected function processData(array &$data): array
    {
        $this->ensureButtonType();
        $this->ensureDisabledStateOnWireLoading();

        $data = array_merge($data, [
            'spinner'    => $this->getSpinner(),
            'tag'        => $this->tag(),
            'iconSize'   => &$this->iconSize,
            'attributes' => &$this->attributes,
        ]);

        if (method_exists($this, 'init')) {
            call_user_func([$this, 'init'], $data);
        }

        return $data;
    }

    public function render(): Closure
    {
        return function (array $data) {
            return view('wireui::components.button', $this->processData($data))->render();
        };
    }
}
