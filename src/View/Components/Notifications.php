<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use WireUi\Traits\Components\HasSetupNotifications;
use WireUi\Traits\Customization\HasSetupPosition;
use WireUi\WireUi\Notification\Positions;

class Notifications extends BaseComponent
{
    use HasSetupPosition;
    use HasSetupNotifications;

    public function __construct()
    {
        $this->setPositionResolve(Positions::class);
    }

    // public const TOP_LEFT      = 'top-left';
    // public const TOP_CENTER    = 'top-center';
    // public const TOP_RIGHT     = 'top-right';
    // public const BOTTOM_LEFT   = 'bottom-left';
    // public const BOTTOM_CENTER = 'bottom-center';
    // public const BOTTOM_RIGHT  = 'bottom-right';

    // public function __construct(
    //     public string $zIndex = 'z-50',
    //     public ?string $position = self::TOP_RIGHT,
    // ) {
    //     $this->position = $this->getPosition($position);
    // }

    // public function render(): View
    // {
    //     return view('wireui::components.notifications');
    // }

    // public function getPosition(?string $position): string
    // {
    //     return Arr::toCssClasses([
    //         'sm:items-start sm:justify-start'  => $position === self::TOP_LEFT,
    //         'sm:items-start sm:justify-center' => $position === self::TOP_CENTER,
    //         'sm:items-start sm:justify-end'    => $position === self::TOP_RIGHT,
    //         'sm:items-end sm:justify-start'    => $position === self::BOTTOM_LEFT,
    //         'sm:items-end sm:justify-center'   => $position === self::BOTTOM_CENTER,
    //         'sm:items-end sm:justify-end'      => $position === self::BOTTOM_RIGHT,
    //     ]);
    // }

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
        return 'wireui::components.notification';
    }
}
