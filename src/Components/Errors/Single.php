<?php

namespace WireUi\Components\Errors;

use Illuminate\Contracts\View\View;
use WireUi\Attributes\Process;
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

    #[Process()]
    protected function process(): void
    {
        if (filled($this->name) && is_null($this->message)) {
            $this->message = $this->errors()->first($this->name);
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
