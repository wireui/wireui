<?php

namespace WireUi\Traits\Components;

use Illuminate\View\ComponentAttributeBag;

trait HasSetupSpinner
{
    public ?ComponentAttributeBag $spinnerRemove = null;

    protected function setupSpinner(array &$component): void
    {
        $this->spinnerRemove = new ComponentAttributeBag();

        $this->setSpinnerVariables($component);
    }

    private function setSpinnerVariables(array &$component): void
    {
        $component['spinner'] = $this->executeSpinner();

        $component['spinnerRemove'] = $this->spinnerRemove;
    }

    private function executeSpinner(): ?ComponentAttributeBag
    {
        $spinner = $this->data->attribute('spinner');

        if (is_null($spinner)) {
            return null;
        }

        $attributes = $this->createAttributes($spinner);

        if (is_string($target = $spinner->expression())) {
            $attributes->offsetSet('wire:target', $target);
        }

        $this->data->offsetUnset($spinner->directive());

        return $attributes;
    }

    private function createAttributes($spinner): ComponentAttributeBag
    {
        $loading = 'wire:loading.delay';

        $spinnerRemove = 'wire:loading.remove';

        if ($delay = $spinner->modifiers()->last()) {
            $loading .= ".{$delay}";

            $spinnerRemove .= ".delay.{$delay}";
        }

        $this->spinnerRemove->offsetSet($spinnerRemove, 'true');

        return new ComponentAttributeBag([$loading => 'true']);
    }
}
