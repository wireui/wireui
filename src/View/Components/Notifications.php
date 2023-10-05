<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupPosition;
use WireUi\WireUi\Notification\Position;

class Notifications extends WireUiComponent
{
    use HasSetupPosition;

    public function __construct(
        public ?string $zIndex = null,
    ) {
        $this->setPositionResolve(Position::class);

        $this->zIndex ??= config('wireui.notifications.z-index', 'z-50');
    }

    public function blade(): View
    {
        return view('wireui::components.notifications');
    }
}
