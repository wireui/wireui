<?php

namespace WireUi\View;

use Illuminate\Support\Str;
use WireUi\Support\ComponentPack;

trait ManageProps
{
    protected array $packs = [];

    protected array $props = [];

    protected function setupProps(): void
    {
        foreach ($this->packs as $pack) {
            $this->managePacks($pack);
        }

        foreach ($this->props as $key => $prop) {
            $this->manageProps($key, $prop);
        }
    }

    private function manageProps(string $key, mixed $value): void
    {
        $field = Str::camel($key);

        $this->{$field} = $this->getData(attribute: $field, default: $value);

        $this->setVariables($field);
    }

    private function managePacks(string $value): void
    {
        $field = Str::camel($value);

        $config = Str::plural($value);

        /** @var ComponentPack $pack */
        $pack = resolve(config("wireui.{$this->config}.packs.{$config}"));

        $this->{$field} = $this->getData($field);

        $this->{"{$field}Classes"} = $pack->get($this->{$field});

        $this->setVariables([$field, "{$field}Classes"]);
    }
}
