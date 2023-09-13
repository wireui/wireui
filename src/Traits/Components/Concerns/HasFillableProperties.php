<?php

namespace WireUi\Traits\Components\Concerns;

trait HasFillableProperties
{
    protected function fill(array $data): void
    {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
