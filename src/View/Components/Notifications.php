<?php

namespace WireUi\View\Components;

use Illuminate\Support\Arr;
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

    public function getRootClasses(): string
    {
        return Arr::toCssClasses([
            'fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-5 sm:pt-4',
            $this->positionClasses,
            $this->zIndex,
        ]);
    }

    public function getView(): string
    {
        return 'wireui::components.notifications';
    }
}
