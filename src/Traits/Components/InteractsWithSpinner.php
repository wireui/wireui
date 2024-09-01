<?php

namespace WireUi\Traits\Components;

use Illuminate\View\ComponentAttributeBag;
use WireUi\Attributes\Mount;
use WireUi\View\Attribute;

trait InteractsWithSpinner
{
    #[Mount(80)]
    protected function mountSpinner(array &$data): void
    {
        /** @var Attribute|null $spinner */
        $spinner = $this->attributes->attribute('spinner');

        if (! $spinner) {
            $data['spinner'] = null;
            $data['spinnerRemove'] = new ComponentAttributeBag;

            return;
        }

        $data['spinner'] = $this->makeSpinnerAttributes($spinner);

        $data['spinnerRemove'] = $this->makeIconContainerAttributes($spinner);
    }

    private function makeSpinnerAttributes(Attribute $spinner): ComponentAttributeBag
    {
        $attributes = new ComponentAttributeBag;

        /** @var string|null $delay */
        $delay = $spinner->modifiers()->last();

        $loading = 'wire:loading';

        if ($delay === 'delay') {
            $loading = 'wire:loading.delay';
        }

        if ($delay && $delay !== 'delay') {
            $loading = "wire:loading.delay.{$delay}";
        }

        $attributes->offsetSet($loading, 'true');

        $this->addTargetAttribute($spinner, $attributes);

        $this->attributes->offsetUnset($spinner->directive());

        return $attributes;
    }

    private function makeIconContainerAttributes(Attribute $spinner): ComponentAttributeBag
    {
        $attributes = new ComponentAttributeBag;

        $attributes->offsetSet('wire:loading.remove', 'true');

        $this->addTargetAttribute($spinner, $attributes);

        return $attributes;
    }

    private function addTargetAttribute(Attribute $spinner, ComponentAttributeBag &$attributes): ComponentAttributeBag
    {
        $target = $spinner->expression();

        if (is_string($target)) {
            $attributes->offsetSet('wire:target', $target);
        }

        return $attributes;
    }
}
