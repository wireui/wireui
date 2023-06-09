<?php

namespace WireUi\Traits\Components;

trait HasSetupCard
{
    public mixed $title = null;

    public bool $borderless = false;

    protected function setupCard(array &$component): void
    {
        $this->title = $this->data->get('title');

        $this->borderless = $this->getBorderless();

        $this->setCardVariables($component);

        $this->smart(['title', 'borderless']);
    }

    private function getBorderless(): bool
    {
        if ($this->data->has('borderless')) {
            return (bool) $this->data->get('borderless');
        }

        return (bool) (config("wireui.{$this->config}.borderless") ?? false);
    }

    private function setCardVariables(array &$component): void
    {
        $component['title'] ??= $this->title;

        $component['borderless'] = $this->borderless;
    }
}
