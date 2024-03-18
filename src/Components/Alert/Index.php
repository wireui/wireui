<?php

namespace WireUi\Components\Alert;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupVariant};
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupVariant;

    protected array $packs = ['shadow', 'padding'];

    protected array $props = [
        'icon'       => null,
        'title'      => null,
        'iconless'   => false,
        'shadowless' => false,
    ];

    protected function processed(array $data): void
    {
        $this->title ??= data_get($data, 'title');
    }

    public function getUseIcon(): mixed
    {
        return $this->icon ?? Arr::get($this->colorClasses, 'icon', 'bell');
    }

    public function blade(): View
    {
        return view('wireui-alert::index');
    }
}
