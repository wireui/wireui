<?php

namespace PH7JACK\LivewireUi\Traits;

trait DynamicChildComponent
{
    public $modelIndex;

    public $syncInput = false;

    abstract protected function getModelName(): string;

    abstract protected function getInputValue();

    abstract protected function getInputName(): string;

    protected function getListeners(): array
    {
        $listeners = ["model:{$this->model}" => 'setInputValue'];

        if (method_exists($this, 'getRawListeners')) {
            $listeners = array_merge($this->getRawListeners(), $listeners);
        }

        if ($this->listeners) {
            $listeners = array_merge($this->listeners, $listeners);
        }

        return $listeners;
    }

    public function setInputValue($value): void
    {
        $input = $this->getInputName();
        $this->syncInput($input, $value);
    }

    public function emitInput()
    {
        $this->emitUp('input', [
            'model'      => $this->getModelName(),
            'value'      => $this->getInputValue(),
            'modelIndex' => $this->modelIndex,
            'sync'       => $this->syncInput,
        ]);
    }
}
