<?php

namespace WireUi\Actions;

use Illuminate\Support\Str;
use Livewire\Component;

class Modal
{
    private Component $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function open(string $modal): void
    {
        $modal = Str::kebab($modal);

        $this->component->dispatch("open-wireui-modal:{$modal}");
    }

    public function close(string $modal): void
    {
        $modal = Str::kebab($modal);

        $this->component->dispatch("close-wireui-modal:{$modal}");
    }
}
