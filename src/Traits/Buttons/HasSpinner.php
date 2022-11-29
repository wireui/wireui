<?php

namespace WireUi\Traits\Buttons;

use Illuminate\View\{Component, ComponentAttributeBag};
use WireUi\View\Attribute;

/** @mixin Component */
trait HasSpinner
{
    protected function getSpinner(): ?ComponentAttributeBag
    {
        /** @var Attribute|null $spinner */
        $spinner = $this->attributes->attribute('spinner');

        if (!$spinner) {
            return null;
        }

        $target  = $spinner->expression();
        $loading = 'wire:loading.delay';

        if ($delay = $spinner->modifiers()->first()) {
            $loading .= ".{$delay}";
        }

        $attributes = new ComponentAttributeBag([$loading => 'true']);

        if (is_string($target)) {
            $attributes->offsetSet('wire:target', $target);
        }

        $this->attributes->offsetUnset($spinner->directive());

        return $attributes;
    }
}
