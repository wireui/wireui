<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupPosition;
use WireUi\WireUi\Notification\Positions;

class Notifications extends BaseComponent
{
    use HasSetupPosition;

    public function __construct(
        public ?string $zIndex = null,
    ) {
        $this->setPositionResolve(Positions::class);

        $this->zIndex ??= config('wireui.notifications.z-index', 'z-50');
    }

    public function blade(): View
    {
        return view('wireui::components.notifications');
    }
}
