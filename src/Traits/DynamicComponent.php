<?php

namespace PH7JACK\LivewireUi\Traits;

use Illuminate\Support\Arr;

trait DynamicComponent
{
    abstract protected function getExtendedModels(): array;

    protected function getListeners(): array
    {
        $listeners = ['input' => 'setModelValue'];

        if (method_exists($this, 'getRawListeners')) {
            $listeners = array_merge($this->getRawListeners(), $listeners);
        }

        if ($this->listeners) {
            $listeners = array_merge($this->listeners, $listeners);
        }

        return $listeners;
    }

    public function setModelValue($data): void
    {
        if (!array_key_exists('model', $data) || !array_key_exists('value', $data)) {
            return;
        }

        $model = $data['model'];
        $value = $data['value'];
        $index = $data['modelIndex'] ?? null;
        $sync  = $data['sync']       ?? false;

        $modelHasDot = strpos($data['model'], '.');

        if ($sync || $modelHasDot !== false) {
            $this->syncInput($model, $value);

            return;
        }

        $attr = $index ? $model[$index] : $model;

        $this->{$attr} = $value;
    }

    protected function refreshExtendedModels(): void
    {
        $extendedModels = $this->getExtendedModels();

        if (!$extendedModels || !(gettype($extendedModels) === 'array')) {
            return;
        }

        foreach ($extendedModels as $component => $model) {
            if (gettype($model) === 'array') {
                foreach ($model as $modelName) {
                    $value = $this->getExtendedModelValue($modelName);
                    $this->emitTo($component, "model:{$modelName}", $value);
                }
            }

            if (gettype($model) === 'string') {
                $value = $this->getExtendedModelValue($model);
                $this->emitTo($component, "model:{$model}", $value);
            }
        }
    }

    private function getExtendedModelValue($model)
    {
        if (strpos($model, '.')) {
            $keys  = explode('.', $model);
            $key   = array_shift($keys);
            $value = data_get($this->{$key}->toArray(), Arr::dot($keys));
        } else {
            $value = $this->{$model};
        }

        return $value;
    }

    protected function refreshExtendedModel($model): void
    {
        $value = $this->{$model};
        $this->emit("model:{$model}", $value);
    }
}
