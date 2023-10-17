<?php

namespace WireUi\View;

use Illuminate\Support\Str;
use WireUi\Support\ComponentPack;

trait ManageProps
{
    protected array $packs = [];

    protected array $props = [];

    protected array $booleans = [];

    protected function setupProps(): void
    {
        foreach ($this->packs as $pack) {
            $this->managePacks($pack);
        }

        foreach ($this->props as $prop) {
            $this->manageProps($prop);
        }

        foreach ($this->booleans as $boolean) {
            $this->manageBooleans($boolean);
        }
    }

    protected function manageProps(string $field): void
    {
        $field = Str::camel($field);

        $this->{$field} = $this->getData($field);

        $this->setVariables($field);
    }

    protected function manageBooleans(string $field): void
    {
        $field = Str::camel($field);

        $this->{$field} = (bool) $this->getData($field);

        $this->setVariables($field);
    }

    protected function managePacks(string $field): void
    {
        $field = Str::camel($field);

        $config = Str::plural($field);

        /** @var ComponentPack $pack */
        $pack = resolve(config("wireui.{$this->config}.packs.{$config}"));

        $this->{$field} = $this->getData($field);

        $this->{"{$field}Classes"} = $pack->get($this->{$field});

        $this->setVariables([$field, "{$field}Classes"]);
    }
}
