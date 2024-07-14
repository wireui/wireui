<?php

namespace WireUi\Components\Errors;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithErrors;
use WireUi\View\WireUiComponent;

class Single extends WireUiComponent
{
    use InteractsWithErrors;

    protected array $props = [
        'name' => null,
        'message' => null,
        'invalidated' => null,
    ];

    protected function processed(): void
    {
        if (filled($this->name)) {
            $this->message ??= $this->errors()->first($this->name);
        }

        if (filled($this->name) && is_null($this->invalidated)) {
            $this->invalidated = $this->errors()->has($this->name);
        }
    }

    public function blade(): View
    {
        return view('wireui-errors::single');
    }
}
