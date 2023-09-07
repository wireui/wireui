<?php

namespace WireUi\Traits\Components;

use Closure;
use Illuminate\Contracts\View\View;

trait IsFormComponent
{
    use HasSharedAttributes;

    public function render(): Closure
    {
        return function (array $data) {
            return $this->blade()->with($this->mergeAttributes($data))->render();
        };
    }

    abstract protected function blade(): View;
}
