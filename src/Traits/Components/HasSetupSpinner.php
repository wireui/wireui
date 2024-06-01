<?php

namespace WireUi\Traits\Components;

use Illuminate\View\ComponentAttributeBag;

trait HasSetupSpinner
{
    private ?ComponentAttributeBag $spinnerRemove = null;

    protected function setupSpinner(array &$data): void
    {
        $this->spinnerRemove = new ComponentAttributeBag();

        $data['spinner'] = $this->executeSpinner();

        $data['spinnerRemove'] = $this->spinnerRemove;
    }

    private function executeSpinner(): ?ComponentAttributeBag
    {
        $spinner = $this->attributes->attribute('spinner');

        if (is_null($spinner)) {
            return null;
        }

        $attributes = $this->createAttributes($spinner);

        if (is_string($target = $spinner->expression())) {
            $attributes->offsetSet('wire:target', $target);
        }

        $this->attributes->offsetUnset($spinner->directive());

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
