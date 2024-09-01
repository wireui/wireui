<?php

namespace WireUi\View;

use Illuminate\Support\Str;
use WireUi\Attributes\Mount;
use WireUi\Support\ComponentPack;

trait InteractsWithProps
{
    protected array $packs = [];

    protected array $props = [];

    #[Mount(50)]
    protected function mountProps(array $data): void
    {
        foreach ($this->packs as $pack) {
            $this->managePacks($pack);
        }

        foreach ($this->props as $key => $prop) {
            $this->manageProps($key, $prop, $data);
        }
    }

    private function manageProps(string $key, mixed $prop, array $data): void
    {
        $field = Str::camel($key);

        $this->{$field} = data_get($data, $key, $this->getData($field, $prop));

        $this->setVariables($field);
    }

    private function managePacks(string $pack): void
    {
        $field = Str::camel($pack);

        $config = Str::plural($pack);

        /** @var ComponentPack $pack */
        $pack = resolve(config("wireui.{$this->config}.packs.{$config}"));

        $this->{$field} = $this->getData($field);

        $this->{"{$field}Classes"} = $pack->get($this->{$field});

        $this->setVariables([$field, "{$field}Classes"]);
    }
}
