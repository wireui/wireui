<?php

namespace WireUi\Traits\Customization;

use Illuminate\View\ComponentAttributeBag;

trait HasSetupSpinner
{
    public mixed $spinnerRemove = null;

    protected function setupSpinner(array &$component): void
    {
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

        $this->spinnerRemove = 'wire:loading.remove';

        if ($delay = $spinner->modifiers()->last()) {
            $loading .= ".{$delay}";

            $this->spinnerRemove .= ".delay.{$delay}";
        }

        $attributes = new ComponentAttributeBag([$loading => 'true']);

        if (is_string($target)) {
            $attributes->offsetSet('wire:target', $target);
        }

        $this->data->offsetUnset($spinner->directive());

        return $attributes;
    }
}
