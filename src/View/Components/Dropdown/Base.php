<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use WireUi\View\Components\WireUiComponent;

class Base extends WireUiComponent
{
    protected array $booleans = ['persistent'];

    protected array $packs = ['width', 'height', 'position'];

    protected function processed(): void
    {
        $this->persistent ??= false;
    }

    public function blade(): View
    {
        return view('wireui::components.dropdown.base');
    }
}
