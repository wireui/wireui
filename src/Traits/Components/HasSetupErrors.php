<?php

namespace WireUi\Traits\Components;

trait HasSetupErrors
{
    public mixed $only = null;

    public mixed $title = null;

    protected function setupErrors(array &$component): void
    {
        $this->title = $this->data->get('title');

        $this->only = $this->data->get('only') ?? [];

        $this->processOnly();

        $this->setErrorsVariables($component);

        $this->smart(['title', 'only']);
    }

    private function processOnly(): void
    {
        if (is_string($this->only)) {
            $this->only = str($this->only)->explode('|');

            $this->only->transform(fn (string $name) => trim($name));
        }

        $this->only = collect($this->only);
    }

    private function setErrorsVariables(array &$component): void
    {
        $component['only'] = $this->only;

        $component['title'] ??= $this->title;
    }
}
