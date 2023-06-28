<?php

namespace WireUi\Traits\Components;

trait HasSetupBadge
{
    public bool $full = false;

    public mixed $label = null;

    protected function setupBadge(array &$component): void
    {
        $this->label = $this->data->get('label');

        $this->full = (bool) ($this->data->get('full') ?? false);

        $this->setBadgeVariables($component);

        $this->smart(['full', 'label']);
    }

    private function setBadgeVariables(array &$component): void
    {
        $component['full'] = $this->full;

        $component['label'] = $this->label;
    }
}
