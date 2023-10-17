<?php

namespace WireUi\View;

use WireUi\Support\ComponentPack;
use Illuminate\Support\Str;

trait ManageProps
{
    protected array $props = [];

    protected array $customs = [];

    protected array $booleans = [];

    protected function setupProps(): void
    {
        foreach ($this->props as $prop) {
            $this->manageProps($prop);
        }

        foreach ($this->customs as $custom) {
            $this->manageCustoms($custom);
        }

        foreach ($this->booleans as $boolean) {
            $this->manageBooleans($boolean);
        }
    }

    protected function manageProps(string $field): void
    {
        $field = Str::camel($field);

        $this->{$field} = $this->getData("{$field}");

        $this->setVariables($field);
    }

    protected function manageCustoms(string $field): void
    {
        $field = Str::camel($field);

        /** @var ComponentPack $pack */
        $pack = resolve(config("wireui.{$this->config}.packs.{$field}s"));

        $this->{$field} = $this->getData("{$field}");

        $this->{"{$field}Classes"} = $pack->get($this->{$field});

        $this->setVariables([$field, "{$field}Classes"]);
    }

    protected function manageBooleans(string $field): void
    {
        $field = Str::camel($field);

        $this->{$field} = boolval($this->getData("{$field}"));

        $this->setVariables($field);
    }
}
