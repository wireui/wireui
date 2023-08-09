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

        $target = $spinner->expression();

        $loading = 'wire:loading.delay';

        $spinnerRemove = 'wire:loading.remove';

        if ($delay = $spinner->modifiers()->last()) {
            $loading .= ".{$delay}";

            $spinnerRemove .= ".delay.{$delay}";
        }

        $this->spinnerRemove->offsetSet($spinnerRemove, 'true');

        $attributes = new ComponentAttributeBag([$loading => 'true']);

        if (is_string($target)) {
            $attributes->offsetSet('wire:target', $target);
        }

        $this->data->offsetUnset($spinner->directive());

        return $attributes;
    }
}
