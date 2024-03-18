<?php

namespace WireUi\Components\Avatar;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupSize};
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;

    protected array $packs = ['border', 'icon-size'];

    protected array $props = [
        'alt'        => null,
        'src'        => null,
        'icon'       => null,
        'label'      => null,
        'borderless' => false,
    ];

    protected function processed(array $data): void
    {
        $this->label ??= data_get($data, 'label');
    }

    public function blade(): View
    {
        return view('wireui-avatar::index');
    }
}
