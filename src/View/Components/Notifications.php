<?php

namespace WireUi\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Notifications extends Component
{
    public string $zIndex;

    public ?string $position;

    public function __construct(
        string $zIndex = 'z-50',
        ?string $position = 'top-right',
    ) {
        $this->zIndex = $zIndex;
        $this->position = $this->setPosition($position);
    }

    public function setPosition($position): string
    {
        return Str::of('')
            ->when($position == 'top-left', function ($string) {
                return $string->append(' sm:items-start sm:justify-start');
            })
            ->when($position == 'top-center', function ($string) {
                return $string->append(' sm:items-start sm:justify-center');
            })
            ->when($position == 'top-right', function ($string) {
                return $string->append(' sm:items-start sm:justify-end');
            })
            ->when($position == 'bottom-left', function ($string) {
                return $string->append(' sm:items-end sm:justify-start');
            })
            ->when($position == 'bottom-center', function ($string) {
                return $string->append(' sm:items-end sm:justify-center');
            })
            ->when($position == 'bottom-right', function ($string) {
                return $string->append(' sm:items-end sm:justify-end');
            });
    }

    public function render()
    {
        return view('wireui::components.notifications');
    }
}
