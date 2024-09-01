<?php

namespace WireUi\Components\Dialog;

use Illuminate\Contracts\View\View;
use WireUi\Actions\Dialog as DialogAction;
use WireUi\Attributes\Process;
use WireUi\View\WireUiComponent;

class Index extends WireUiComponent
{
    public string $dialog = '';

    protected array $packs = ['align', 'blur', 'width', 'type'];

    protected array $props = [
        'id' => null,
        'title' => null,
        'spacing' => null,
        'z-index' => null,
        'blurless' => false,
        'description' => null,
    ];

    #[Process()]
    protected function process(): void
    {
        $this->dialog = DialogAction::makeEventName($this->id);

        $this->setVariables('dialog');
    }

    public function blade(): View
    {
        return view('wireui-dialog::index');
    }
}
